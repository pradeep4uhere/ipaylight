<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && $user->status == 'inactive') {
            // Set a session message
            $request->session()->flash('error', getLocalText('you_are_not_authorized'));
            // Redirect to the dashboard
            return redirect()->route('ds.dashboard');
        }
        return $next($request);
    }
}
