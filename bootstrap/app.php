<?php

use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsModeratorMiddleware;
use App\Http\Middleware\IsStudentMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => IsAdminMiddleware::class,
            'isModerator' => IsModeratorMiddleware::class,
            'isStudent' => IsStudentMiddleware::class,
        ])
        ->redirectGuestsTo(function (Request $request) {
            route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
