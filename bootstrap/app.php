<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authorizer;
use App\Http\Middleware\Provider;
use App\Http\Middleware\Normal;
use App\Http\Middleware\AdminAuthMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'authorizer'=>Authorizer::class,
        // 'provider'=>Provider::class,
        // 'normal'=>Normal::class,
        'role.redirect' => RoleRedirect::class, // Register the new middleware here
        'auth.admin' => AdminAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();