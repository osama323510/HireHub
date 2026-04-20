<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
                'is_freelancer' => \App\Http\Middleware\IsFreelancer::class,
                'is_client'     => \App\Http\Middleware\IsClients::class,
            ]);

        $middleware->append(\App\Http\Middleware\watchRequestMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {
        $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
        if ($request->is('api/offer/*')) { 
                return response()->json([
                'success' => false,
                'message' => 'THERE IS NOT OFFER',
            ], $statusCode);
            }

        });


    })->create();
