<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserRole
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
        if (Auth::user()->role != 'user') {
            return redirect()->back();
        }
        if (Auth::user()->is_complete == 0) {
            return redirect()->route('user.wait');
        }
        return $next($request);
    }
}
