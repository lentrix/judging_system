<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;
use App\Score;

class CriteriaController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'criteria' => 'required',
            'description' => 'required',
            'max' => 'required|numeric'
        ]);

        $round = \App\Round::find($request['round_id']);

        $criteria = Criteria::create([
            'criteria' => $request['criteria'],
            'description' => $request['description'],
            'max' => $request['max'],
            'round_id' => $request['round_id'],
            'order' => $round->nextCriteriaNumber
        ]);

        return redirect()->back()->with('Info', 'A criteria has been added.');
    }

    public function delete(Request $request) {

        $criteria = Criteria::find($request['id']);
        $criteria->delete();

        return redirect()->back()->with('Info','A criteria has been deleted.');
    }

    public function moveUp(Criteria $criteria) {
        $previous = $criteria->previousCriteria;

        if($previous) {
            $ord = $previous->order;
            $previous->order = $criteria->order;
            $criteria->order = $ord;

            $previous->save();
            $criteria->save();
        }

        return redirect()->back();
    }

    public function moveDown(Criteria $criteria) {
        $next = $criteria->nextCriteria;

        if($next) {
            $ord = $next->order;
            $next->order = $criteria->order;
            $criteria->order = $ord;

            $next->save();
            $criteria->save();
        }

        return redirect()->back();
    }

    public function summary(Criteria $criteria) {
        $computation = [];
        $totals = [];

        foreach($criteria->round->contestants as $contestant) {
            $total = 0;
            foreach($criteria->round->contest->contestJudges as $contestJudge) {
                $score = Score::get($contestJudge->user_id, $contestant->id, $criteria->id);
                $total += $score;
                $computation[$contestant->id][$contestJudge->user_id] = $score;
            }
            $computation[$contestant->id]['total'] = $total;
            $totals[] = $total;
        }

        return view('criterias.summary', [
            'criteria'=>$criteria,
            'computation'=>$computation,
            'totals' => $totals]);
    }
}
