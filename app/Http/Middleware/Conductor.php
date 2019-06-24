<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class Conductor
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
        if (Auth::check() && Auth::user()->rol == 2) {
            return redirect()->route('/empresa');
        } elseif (Auth::check() && Auth::user()->rol == 3) {
            return redirect()->route('/conductor');
        } else {
            return redirect()->route('login');
        }
    }
}
