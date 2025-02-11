<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // dd(Auth::user()->role);
        // if (Auth::check() && Auth::user()->role === $role) {
        //     return $next($request);
        // }
        dd(auth('sanctum')->user());
        
        if (auth('sanctum')->check() && auth('sanctum')->user()->role === $role) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
