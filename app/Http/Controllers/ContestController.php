<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;

class ContestController extends Controller
{
    public function create() {
        return view('contests.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' =>'required',
            'schedule'=>'required',
            'venue' => 'required'
        ]);

        $contest = Contest::create([
            'title' => $request['title'],
            'schedule' => $request['schedule'],
            'venue' => $request['venue'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect("/contest/$contest->id");
    }

    public function manage(Contest $contest) {
        return view('contests.manage', compact('contest'));
    }
}
