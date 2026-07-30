<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if($request->user()->role !== $role){
            if($request->user()->role=='distributor'){
                return redirect('ds/dashboard');
            }else if($request->user()->role=='retailer'){
                return redirect('ro/dashboard');
            }else if($request->user()->role=='superdistributor'){
                return redirect('sds/dashboard');
            }else if($request->user()->role=='user'){
                return redirect('/dashboard');
            }else {
                return redirect($request->user()->role.'/dashboard');
            }
        }
        return $next($request);
    }
}
