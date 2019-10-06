<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;

class SiteController extends Controller
{
    public function loginForm() {
        if(auth()->guest())
            return view('site.login');
        else
            return redirect()->home();
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = auth()->attempt([
            'username' => $request['username'],
            'password' => $request['password']
        ]);

        if($login) {
            return redirect()->home();
        }else {
            return redirect()->back()->with('Error','Invalid username and/or password.');
        }
    }

    public function home() {
        if(auth()->user()->role=="admin") {
            $contests = Contest::orderBy('created_at','desc')->get();
            return view('site.admin-home', compact('contests'));
        }else {
            return view('site.judge-home');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
