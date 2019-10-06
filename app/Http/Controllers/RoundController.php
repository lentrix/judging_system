<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;

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
}
