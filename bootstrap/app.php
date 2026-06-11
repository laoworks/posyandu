<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectUsersTo(function ($request): string {
            $dashboardRoute = $request->user()?->dashboardRouteName();

            return $dashboardRoute !== null
                ? route($dashboardRoute, absolute: false)
                : route('dashboard', absolute: false);
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
