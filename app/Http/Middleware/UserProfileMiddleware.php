<?php

namespace App\Http\Middleware;

use Closure;

class UserProfileMiddleware
{
    public function handle($request, Closure $next)
    {
        $userProfile = auth()->user();

        // Share the user profile data with all views
        view()->share('userProfile', $userProfile);

        return $next($request);
    }
}
