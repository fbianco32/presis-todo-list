<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    if ($request->bearerToken() !== 'porFavor') {
        return response()->json([
            'data' => "No dijiste por favor (porFavor es el bearer token)"
        ], 400);
    }

    return $next($request);
    }
}
