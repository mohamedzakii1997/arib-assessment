<?php

use App\Http\Middleware\AuthenticateEmployeeWeb;
use App\Http\Middleware\AuthenticateManagerWeb;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\ManagerMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    // Register global middlewares
    $middleware->alias([
        'manager'=> ManagerMiddleware::class,
        'employee'=> EmployeeMiddleware::class,
        'AuthenticateManagerWeb'=>AuthenticateManagerWeb::class,
        'AuthenticateEmployeeWeb'=>AuthenticateEmployeeWeb::class
    ]);



})->withExceptions(function (Exceptions $exceptions) {
        // Exception handling configuration (if needed)
    })->create();
