<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->enabled) {
            return redirect()->route('petition');
        }

        if (auth()->user()->role) {
            return redirect()->route('usersAdmin');
        }

        return $next($request);
    }
}
