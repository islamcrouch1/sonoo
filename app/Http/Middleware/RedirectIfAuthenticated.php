<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->hasRole('affiliate')) {
                    return redirect(RouteServiceProvider::HOME_FOR_AFFILIATE);
                } elseif (Auth::user()->hasRole('vandor')) {
                    return redirect(RouteServiceProvider::HOME_FOR_VENDOR);
                } elseif (Auth::user()->hasRole('administrator|superadministrator')) {
                    return redirect(RouteServiceProvider::HOME_FOR_ADMIN);
                }
            }
        }

        return $next($request);
    }
}
