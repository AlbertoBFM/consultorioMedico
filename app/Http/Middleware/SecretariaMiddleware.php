<?php

namespace App\Http\Middleware;

date_default_timezone_set("America/La_Paz");

use Closure;
use Illuminate\Http\Request;

class SecretariaMiddleware
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
        if (auth()->check() && (auth()->user()->secretaria_id != null))
            if (auth()->user()->secretaria->turnos_id == 1 && (date('Hi') >= '0830' && date('Hi') < '1430')) {
                return $next($request);
            }
            elseif (auth()->user()->secretaria->turnos_id == 2 && (date('Hi') >= '1430' && date('Hi') < '2030')) {
                return $next($request);
            }

        return back();
    }
}
