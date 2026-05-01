<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiLog;

class ApiLogger
{
    public function handle(Request $request, Closure $next)
    {
        ApiLog::create([
            'user_id' => $request->user()?->id,
            'ip' => $request->ip(),
            'endpoint' => $request->path(),
        ]);

        return $next($request);
    }
}