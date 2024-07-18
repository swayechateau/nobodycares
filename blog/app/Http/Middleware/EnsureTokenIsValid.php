<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // check bearer token
        $bearerToken = $request->bearerToken();
        if ($bearerToken !== config('app.api_token')) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
