<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminRedirect;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\UserRedirect;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->redirectTo(
        //     guests:'/admin',
        //     users:'/admin/dashboard',
        // );
        $middleware->alias([
            'auth.user'=>UserMiddleware::class,
            'auth.admin'=>AdminMiddleware::class,
            'guest.user'=>UserRedirect::class,
            'guest.admin'=>AdminRedirect::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
