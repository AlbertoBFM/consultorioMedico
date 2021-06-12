<?php

namespace App\Http\Middleware;

date_default_timezone_set("America/La_Paz");

use Closure;
use Illuminate\Http\Request;

class JefeMedicoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->jefemedico_id != null) && (date('Hi') >= '0830' && date('Hi') <= '2030'))
            return $next($request);
        return back();
    }
}
