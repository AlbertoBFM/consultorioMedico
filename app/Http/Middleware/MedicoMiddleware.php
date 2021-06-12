<?php

namespace App\Http\Middleware;

date_default_timezone_set("America/La_Paz");

use Closure;
use Illuminate\Http\Request;

class MedicoMiddleware
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
        if (auth()->check() && (auth()->user()->medico_id != null)){
            if (auth()->user()->medico->turnos_id == 3 && (date('Hi') >= '0830' && date('Hi') < '1230')) {
                return $next($request);
            }
            elseif (auth()->user()->medico->turnos_id == 4 && (date('Hi') >= '1230' && date('Hi') < '1630')) {
                return $next($request);
            }
            elseif (auth()->user()->medico->turnos_id == 5 && (date('Hi') >= '1630' && date('Hi') <= '2030')) {
                return $next($request);
            }
            elseif (auth()->user()->medico->turnos_id == 6 && (date('Hi') >= '0830' && date('Hi') <= '2030')) {
                return $next($request);
            }
        }
        return back();
    }
}
