<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleController extends Controller
{
    public function limited(Request $request)
    {
        $key = $request->user()?->id ?? $request->ip();

        $executed = RateLimiter::attempt(
            'api-limit:' . $key,
            $perMinute = 5,
            function () {
                return true;
            }
        );

        if (!$executed) {
            return response()->json([
                'message' => 'Too many requests (5 per minute limit)'
            ], 429);
        }

        return response()->json([
            'message' => 'Request successful'
        ]);
    }

    public function strict(Request $request)
    {
        $key = $request->ip();

        $executed = RateLimiter::attempt(
            'strict-limit:' . $key,
            3,
            fn() => true
        );

        if (!$executed) {
            return response()->json([
                'message' => 'Strict limit reached (3 per minute)'
            ], 429);
        }

        return "Strict Throttle Working";
    }
}