<?php

namespace App\Http\Middleware;

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
        if (auth()->check() && (auth()->user()->medico_id != null))
            return $next($request);

        return back();
    }
}
