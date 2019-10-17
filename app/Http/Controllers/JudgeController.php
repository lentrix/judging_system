<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContestJudge;
use App\Contest;
use App\User;

class JudgeController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'password' => 'required',
            'contest_id' => 'required|numeric'
        ]);

        $user = User::create([
            'username' => $request['username'],
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'role' => 'judge'
        ]);

        $contest = \App\Contest::find($request['contest_id']);

        ContestJudge::create([
            'user_id' => $user->id,
            'contest_id' => $request['contest_id'],
            'order' => $contest->nextJudgeNumber
        ]);

        return redirect()->back();
    }

    public function addExisting(Request $request) {
        $contest = Contest::find($request['contest_id']);

        $contestJudge = ContestJudge::where('user_id', $request['user_id'])
                    ->where('contest_id', $request['contest_id'])->first();

        if(!$contestJudge) {
            \App\ContestJudge::create([
                'user_id' => $request['user_id'],
                'contest_id' => $contest->id,
                'order' => $contest->nextJudgeNumber
            ]);
            return redirect()->back()->with('Info','New contest judge added.');
        }

        return redirect()->back()->with('Error','Contest judge already exists.');
    }

    public function delete(ContestJudge $contestJudge) {
        //check if there are no scores made..
        //to be done later

        $contestJudge->delete();

        return redirect()->back();
    }

    public function moveUp(ContestJudge $contestJudge) {
        $prev = $contestJudge->previousJudge;
        if($prev) {
            $ord = $prev->order;
            $prev->order = $contestJudge->order;
            $contestJudge->order = $ord;
            $prev->save();
            $contestJudge->save();
        }
        return redirect()->back();
    }

    public function moveDown(ContestJudge $contestJudge) {
        $next = $contestJudge->nextJudge;
        if($next) {
            $ord = $next->order;
            $next->order = $contestJudge->order;
            $contestJudge->order = $ord;
            $next->save();
            $contestJudge->save();
        }
        return redirect()->back();
    }
}
