<?php

namespace App\Http\Middleware;

use Closure;

class Parents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return back();
        }

        return $next($request);
        
    }
}
