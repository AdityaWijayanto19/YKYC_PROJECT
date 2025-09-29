<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'profile.complete' => \App\Http\Middleware\EnsureProfileIsComplete::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'midtrans/callback', // <-- URL yang kita izinkan
            'midtrans/*' // <-- Atau gunakan wildcard untuk semua rute di bawah /midtrans
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
