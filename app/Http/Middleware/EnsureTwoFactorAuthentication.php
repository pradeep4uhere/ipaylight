<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorAuthentication
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->uses_two_factor_auth && !$request->session()->has('2fa_passed')) {
            return redirect()->route('2fa.show');
        }

        return $next($request);
    }
}
