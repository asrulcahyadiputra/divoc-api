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
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\Authenticate::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\App\Exceptions\BusinessException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors'  => $e->getContext(),
            ], $e->getStatusCode());
        });

        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        });

    })->create();
