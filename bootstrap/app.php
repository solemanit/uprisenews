<?php

use App\Http\Middleware\DisableRegistration;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Disable registration routes by adding the middleware to the stack.
        $middleware->prepend(DisableRegistration::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
