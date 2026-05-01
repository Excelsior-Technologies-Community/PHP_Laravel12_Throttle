<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LogController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| BASIC THROTTLE (5 requests per minute)
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:5,1')->group(function () {

    Route::get('/limited', function () {
        return view('limited', [
            'message' => 'You can access this route only 5 times per minute.'
        ]);
    });

});

/*
|--------------------------------------------------------------------------
| CUSTOM THROTTLE (3 requests per minute)
|--------------------------------------------------------------------------
*/


Route::get('/admin/logs', [LogController::class, 'index']);


Route::middleware('throttle:custom-limit')->group(function () {

    Route::get('/custom-limited', function () {
        return view('custom', [
            'message' => 'Custom throttle: 3 requests per minute.'
        ]);
    });

});