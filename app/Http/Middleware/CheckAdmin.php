<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 'admin') {

            return $next($request);
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect()->route('welcomepage');
        }
        return redirect()->route('login');
    }
}
