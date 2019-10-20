<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;
use App\Score;
use App\Contestant;

class RoundController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $contest = \App\Contest::find($request['contest_id']);

        $round = Round::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'contest_id' => $request['contest_id'],
            'round_order' => $contest->nextRoundNumber
        ]);

        return redirect()->back();
    }

    public function manage(Round $round) {
        return view('rounds.manage', compact('round'));
    }

    public function moveDown(Round $round) {
        if($round->contest->status <> "pending")
            return redirect()->back()->with('Error','Sorry, the contest is no longer in pending state.');

        $nextRound = $round->nextRound;
        if($nextRound) {
            $nr = $nextRound->round_order;
            $nextRound->round_order = $round->round_order;
            $round->round_order = $nr;

            $round->save();
            $nextRound->save();
        }

        return redirect()->back();
    }

    public function moveUp(Round $round) {
        if($round->contest->status <> "pending")
            return redirect()->back()->with('Error','Sorry, the contest is no longer in pending state. Current Status: ' . $round->contest->status);

        $previousRound = $round->previousRound;
        if($previousRound) {
            $nr = $previousRound->round_order;
            $previousRound->round_order = $round->round_order;
            $round->round_order = $nr;

            $round->save();
            $previousRound->save();
        }

        return redirect()->back();
    }

    public function commence(Round $round) {
        $round->contest->status = $round->id;
        $round->contest->save();
        return redirect()->back();
    }

    public function suspend(Round $round) {
        $round->contest->status = "pending";
        $round->contest->save();
        return redirect()->back()->with('Info','The round has been suspended.');
    }

    public function summary(Round $round) {
        $totalsAndRanks = [];
        $contestJudges = $round->contest->contestJudges;

        foreach($contestJudges as $contestJudge) {
            $totalsAndRanks[$contestJudge->id] = Score::totalAndRank($round->id, $contestJudge->user_id);
        }

        $sumsOfRanks = [];
        $sumsOfRanksSorted = [];
        foreach($round->contestants as $contestant) {
            $sum = 0;
            foreach($contestJudges as $contestJudge) {
                $sum += $totalsAndRanks[$contestJudge->id][$contestant->name]['rank'];

            }
            $sumsOfRanks[$contestant->name] = $sum;
            $sumsOfRanksSorted[]=$sum;
        }

        return view('rounds.summary',[
            'round' => $round,
            'contestJudges' => $contestJudges,
            'totalsAndRanks' => $totalsAndRanks,
            'sumsOfRanks' => $sumsOfRanks,
            'sumsOfRanksSorted' => $sumsOfRanksSorted,
        ]);
    }

    public function advance(Round $round, Request $request) {

        foreach($request['qualifier'] as $qualifier) {
            $c = Contestant::find($qualifier);
            Contestant::create([
                'name' => $c->name,
                'details' => $c->details,
                'order' => $c->order,
                'round_id' => $round->nextRound->id
            ]);
        }

        $round->contest->status = $round->nextRound->id;
        $round->contest->save();

        return redirect("/round/{$round->nextRound->id}");
    }

    public function reset(Request $request) {
        $round = Round::find($request['round_id']);

        if(!$round) {
            return redirect()->back()->with('Error','Invalid Round ID' . $request['round_id']);
        }

        \App\Score::whereIn('criteria_id', \App\Criteria::where('round_id', $round->id)->pluck('id'))->delete();

        return redirect()->back()->with('Info',"$round->name of {$round->contest->title} has been reset.");
    }

    public function delete(Request $request) {
        $round = Round::find($request['id'])->first();

        if(count($round->contestants)==0 && count($round->criterias)==0) {
            $round->delete();
            return redirect()->back()->with('Info','The round has been deleted.');
        }else {
            return redirect()->back()->with('Error','The round still contains contestants or criterias. Unable to delete.');
        }
    }


}
