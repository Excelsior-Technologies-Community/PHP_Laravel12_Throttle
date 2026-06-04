<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;
use App\Http\Middleware\ApiLogger;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('throttle:5,1')->group(function () {
    Route::get('/limited', function () {
        return view('limited', [
            'message' => 'You can access this route only 5 times per minute.'
        ]);
    });
});

Route::middleware(['throttle:custom-limit', ApiLogger::class])->group(function () {
    Route::get('/custom-limited', function () {
        return view('custom', [
            'message' => 'Custom throttle: 3 requests per minute.'
        ]);
    });
});

Route::middleware([ApiLogger::class])->group(function () {
    Route::get('/admin/logs', [LogController::class, 'index']);
});