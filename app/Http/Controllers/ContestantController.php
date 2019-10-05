<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Round;
use App\Contestant;

class ContestantController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'round_id' => 'required|numeric'
        ]);

        $round = Round::find($request['round_id']);

        Contestant::create([
            'name' => $request['name'],
            'details' => $request['details'],
            'remarks' => $request['remarks'],
            'round_id' => $round->id,
            'order' => $round->nextContestantNumber
        ]);

        return redirect()->back()->with('Info','New contestant added.');
    }

    public function delete(Contestant $contestant) {
        //check first if there are not scores before deleting
        //to added later

        $contestant->delete();
        return redirect()->back();
    }

    public function moveDown(Contestant $contestant) {
        $next = $contestant->nextContestant;
        if($next) {
            $ord = $next->order;
            $next->order = $contestant->order;
            $contestant->order = $ord;
            $next->save();
            $contestant->save();
        }
        return redirect()->back();
    }

    public function moveUp(Contestant $contestant) {
        $previous = $contestant->previousContestant;
        if($previous) {
            $ord = $previous->order;
            $previous->order = $contestant->order;
            $contestant->order = $ord;
            $previous->save();
            $contestant->save();
        }
        return redirect()->back();
    }
}
