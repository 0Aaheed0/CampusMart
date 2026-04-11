<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtFromCookie
{
    public function handle($request, Closure $next)
    {
        // Skip JWT injection during testing - tests use session auth
        if (app()->environment('testing')) {
            return $next($request);
        }

        if (!$request->bearerToken() && $request->hasCookie('token')) {
            $token = $request->cookie('token');
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}