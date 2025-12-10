<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->alias([
        //     'auth.superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        //     'auth.admin'      => \App\Http\Middleware\AdminMiddleware::class,
        //     'auth.customer'   => \App\Http\Middleware\CustomerMiddleware::class,
        // ]);

        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
            'auth.customer' => \App\Http\Middleware\CustomerMiddleware::class,
            'auth.admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('customer/*')) {
                return route('customer.login');
            }

            // *** ADD THIS CHECK FOR ADMIN ROUTES ***
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('login');
        });


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
