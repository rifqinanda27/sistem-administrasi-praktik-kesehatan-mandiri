<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     if (!auth()->user() || auth()->user()->role->name !== $role) {
    //         return response()->json(['message' => 'Forbidden'], 403);
    //     }

    //     return $next($request);
    // }
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     $user = $request->user();

    //     if ($user && $user->role->name !== $role) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user || !in_array($user->role->name, $roles)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }

}
