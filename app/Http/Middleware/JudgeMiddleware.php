<?php

namespace App\Http\Middleware;

use Closure;

class JudgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == "judge")
            return $next($request);

        return redirect()->back()->with('Error', "Sorry, this module is for judges only.");
    }
}
