<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif(Auth::user()->role == 'student') {
                return redirect('/student/dashboard');
            }elseif(Auth::user()->role == 'agent') {
                return redirect('/agent/dashboard');
            }
        }

        return $next($request);
    }
}
