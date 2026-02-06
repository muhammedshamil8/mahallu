<?php

namespace App\Http\Middleware;

use Closure;
use Auth; //at the top
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->role == 'admin') {
        return $next($request);
    }
    elseif (Auth::check() && Auth::user()->role == 'agent') {
        return redirect('/agent/dashboard');
    }
    elseif (Auth::check() && Auth::user()->role == 'student') {
        return redirect('/student/dashboard');
    }
    else {
        return redirect('/login');
    }
}
}
