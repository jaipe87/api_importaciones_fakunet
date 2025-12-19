<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BearerTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        // Debe venir en formato: "Bearer XXXXX"
        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Extraer el token
        $token = substr($authorization, 7);

        // Comparar con token definido en .env
        if ($token !== env('API_BEARER_TOKEN')) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
