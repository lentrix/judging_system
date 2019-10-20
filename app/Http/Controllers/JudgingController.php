<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContestJudge;
use App\Contest;
use App\Score;

class JudgingController extends Controller
{
    public function index(Contest $contest) {
        // determine active round and display scoresheet.
        // Otherwise, Display a message.

        $contestJudge = ContestJudge::where('user_id', auth()->user()->id)
                ->where('contest_id', $contest->id)->first();
        if($contest->currentRound) {
            $totalAndRank = Score::totalAndRank($contest->currentRound->id, $contestJudge->id);
        }else {
            $totalAndRank = false;
        }

        return view('judging.index', [
            'contest' => $contest,
            'totalAndRank' => $totalAndRank,
            'contestJudge' => $contestJudge
        ]);
    }

    public function saveScores(Request $request) {

        $contestJudge = ContestJudge::where('user_id', auth()->user()->id)
                ->where('contest_id', $request['contest_id'])->first();

        foreach($request['score'] as $cont=>$row) {
            foreach($row as $crit=>$score) {
                $theScore = $score ? $score : 0;
                Score::createOrUpdate($contestJudge->id, $cont, $crit, $theScore);
            }
        }
        return redirect()->back()->with('Info','Scores last updated: ' . date('M d, Y g:i:s'));
    }
}
