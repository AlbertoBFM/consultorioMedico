<?php

namespace App\Http\Middleware;

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
            return $next($request);

        return back();
    }
}
