<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class authenticationUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();        
        $user = User::where('user_token', $token)->first();
        if ($user) {
            auth()->login($user);
            return $next($request);
        }
        return response([
            'message' => 'Unauthenticated'
        ], 403);
 
        return $next($request);
    }
}
