<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Score;

class JudgingController extends Controller
{
    public function index(Contest $contest) {
        // determine active round and display scoresheet.
        // Otherwise, Display a message.
        if($contest->currentRound) {
            $totalAndRank = Score::totalAndRank($contest->currentRound->id, auth()->user()->id);
        }else {
            $totalAndRank = false;
        }

        return view('judging.index', [
            'contest' => $contest,
            'totalAndRank' => $totalAndRank
        ]);
    }

    public function saveScores(Request $request) {

        foreach($request['score'] as $cont=>$row) {
            foreach($row as $crit=>$score) {
                $theScore = $score ? $score : 0;
                Score::createOrUpdate(auth()->user()->id, $cont, $crit, $theScore);
            }
        }
        return redirect()->back()->with('Info','Scores last updated: ' . date('M d, Y g:i:s'));
    }
}
