<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;

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

    public function delete(Criteria $criteria) {
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
}
