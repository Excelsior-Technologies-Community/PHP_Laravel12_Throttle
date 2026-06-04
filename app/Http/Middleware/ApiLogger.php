<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\ApiLog;

class ApiLogger
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $limit = $user && $user->is_premium ? 100 : 10;
        
     
        $key = $request->ip();

       
        if (RateLimiter::tooManyAttempts($key, $limit)) {
            ApiLog::create([
                'user_id' => $user ? $user->id : null,
                'ip' => $request->ip(),
                'endpoint' => $request->fullUrl(),
                'status_code' => 429,
                'method' => $request->method(),
            ]);
            return response()->json(['message' => 'Too many requests'], 429);
        }

      
        RateLimiter::hit($key, 60);

        $response = $next($request);
        
        ApiLog::create([
            'user_id' => $user ? $user->id : null,
            'ip' => $request->ip(),
            'endpoint' => $request->fullUrl(),
            'status_code' => $response->getStatusCode(),
            'method' => $request->method(),
        ]);

        return $response;
    }
}