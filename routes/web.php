<?php

use Illuminate\Support\Facades\Route;


Route::middleware('throttle:5,1')->group(function () {

    Route::get('/limited', function () {
        return "You can access this route only 5 times per minute.";
    });

});

Route::middleware('throttle:custom-limit')->group(function () {

    Route::get('/custom-limited', function () {
        return "Custom throttle: 3 requests per minute.";   
    });

});


Route::get('/', function () {
    return view('welcome');
});
