<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
{
    public function handle($request, Closure $next)
    {
        if($request -> header("x-api-key") !== env("API_KEY"))
            return response()->json(["error" => "Invalid api key"], 500);

        if($request -> header("Accept-Language"))
            app() -> setLocale(strtolower($request -> header("Accept-Language")));

        return $next($request);
    }
}
