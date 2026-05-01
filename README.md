# PHP_Laravel12_Throttle

## Project Introduction

PHP_Laravel12_Throttle is a Laravel 12 demonstration project designed to showcase the implementation of request rate limiting (throttling) using Laravel’s built-in Throttle Middleware and RateLimiter system.

Rate limiting is a critical security feature in modern web applications. It helps prevent abuse, brute-force attacks, API overuse, and spam by limiting the number of requests a user can make within a specific time period.

This project provides a clear, structured, and practical implementation of route-level throttling and custom rate limit definitions using Laravel 12’s native features — without requiring any third-party packages.

---

## Project Overview

This project demonstrates how to configure and test request throttling in Laravel 12 using:

- Built-in ThrottleRequests Middleware

- RateLimiter Facade

- Custom named rate limiters

- Route-level throttle application

- Cache-based request tracking

- HTTP 429 response handling

---

## Step 1: Create Laravel 12 Project

```bash
composer create-project laravel/laravel PHP_Laravel12_Throttle
cd PHP_Laravel12_Throttle
```

Start the server:

```bash
php artisan serve
```

Open in browser:

```bash
http://127.0.0.1:8000
```

---

## Step 2: Understanding Laravel Throttle

Laravel provides built-in rate limiting using:

- ThrottleRequests Middleware

- RateLimiter Facade

- throttle Route Middleware

Throttle middleware location (for understanding):

```bash
vendor/laravel/framework/src/Illuminate/Routing/Middleware/ThrottleRequests.php
```

---

## Step 3: .env Configuration

Ensure .env has:

```.env
CACHE_DRIVER=file
```
Throttle works using cache.

---

## Step 4: Basic Route Throttling (5 Requests Per Minute)

Open:

routes/web.php

Add:

```php
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:5,1')->group(function () {

    Route::get('/limited', function () {
        return "You can access this route only 5 times per minute.";
    });

});
```

Explanation:

5 → Maximum attempts

1 → Per minute

After 5 refreshes → You will get:

```
429 | Too Many Requests
```

---

## Step 5: Create Custom Rate Limiter

Open:

app/Providers/AppServiceProvider.php

Add inside boot() method:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    RateLimiter::for('custom-limit', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip());
    });
    }
}
```

What This Means:

- Custom name: custom-limit

- 3 requests per minute

- Identified by user IP

---

## Step 6: Apply Custom Throttle to Route

Open:

routes/web.php

Add:

```php
Route::middleware('throttle:custom-limit')->group(function () {

    Route::get('/custom-limited', function () {
        return "Custom throttle: 3 requests per minute.";   
    });

});
```
Now this route allows only 3 requests per minute.

---

## Step 7: Testing Throttle

Open:

```bash
http://127.0.0.1:8000/limited
```

Refresh more than 5 times quickly.

You will see:

- HTTP 429 Status

- Retry-After header

- Too Many Requests error

Open:

```bash
http://127.0.0.1:8000/custom-limited
```

Refresh 3 times quickly → You should see:

429 Too Many Requests

---

## How To Reset Throttle Immediately (For Testing)

Instead of waiting 1 minute:

Option 1:

Restart server:

```bash
Ctrl + C
php artisan serve
```

Option 2 (Best):

Clear cache:

```bash
php artisan cache:clear
```

---

## Output

<img width="1824" height="1078" alt="Screenshot 2026-02-27 123040" src="https://github.com/user-attachments/assets/76d82c4c-db66-4263-a4f3-57603e9ac79e" />

<img width="1827" height="1089" alt="Screenshot 2026-02-27 123217" src="https://github.com/user-attachments/assets/c4e2d145-bfc0-4782-927f-2cbe6d5ccad8" />

<img width="1815" height="1088" alt="Screenshot 2026-02-27 130145" src="https://github.com/user-attachments/assets/4cc039f0-b71d-4e7e-864f-baf2336a83c7" />

<img width="1818" height="1071" alt="Screenshot 2026-02-27 130159" src="https://github.com/user-attachments/assets/f676c1de-10f0-4794-b4f8-d741ad2a2867" />

---

## Project Structure

```
PHP_Laravel12_Throttle/
│
├── app/
│   └── Providers/
│       └── AppServiceProvider.php
│
├── routes/
│   ├── web.php
│   
│
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── storage/
├── .env
└── README.md
```

---

Your PHP_Laravel12_Throttle Project is now ready!
<<<<<<< HEAD


=======
>>>>>>> development
