<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TrainerRole
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
        if (Auth::user()->role != 'trainer') {
            return redirect()->back();
        }
        if (Auth::user()->is_complete == 0) {
            return redirect()->route('user.wait');
        }
        return $next($request);
    }
}
