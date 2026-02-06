<?php

namespace App\Http\Middleware;

use Closure;
use Auth; //at the top
class Customer
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
    if (Auth::check() && Auth::user()->role == 'student') {
        return $next($request);
    }
    elseif (Auth::check() && Auth::user()->role == 'agent') {
        return redirect('/agent/dashboard');
    }
    elseif (Auth::check() && Auth::user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }
    else {
        return redirect('/login');
    }
}
}
