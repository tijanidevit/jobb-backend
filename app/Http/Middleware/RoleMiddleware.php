<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user || $user->role->value !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You do not have the required role.'
            ], 403);
        }


        return $next($request);
    }
}
