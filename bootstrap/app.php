<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin' => AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->render(function (Throwable $e, $request) {
            // Handle Validation errors
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed',
                    'errors'  => $e->errors(),
                ], 422);
            }

            // Authentication errors
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unauthenticated',
                ], 401);
            }

            // Direct JWTAuth exceptions
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Token has expired',
                ], 401);
            }

            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Invalid token',
                ], 401);
            }

            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Token not provided or invalid',
                ], 401);
            }

            // Wrapped JWT errors (HttpResponseException)
            if ($e instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
                $response = $e->getResponse();

                if ($response && method_exists($response, 'getContent')) {
                    $content = json_decode($response->getContent(), true);

                    if (isset($content['error'])) {
                        return response()->json([
                            'status'  => 'error',
                            'message' => $content['error'],
                        ], $response->getStatusCode() ?: 401);
                    }

                    if (isset($content['message'])) {
                        return response()->json([
                            'status'  => 'error',
                            'message' => $content['message'],
                        ], $response->getStatusCode() ?: 401);
                    }
                }

                // Fallback for unknown structure
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unexpected HTTP response',
                ], 500);
            }

            // Not found errors
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Endpoint not found',
                ], 404);
            }

            // Fallback for any other unhandled exceptions
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage() ?: 'Something went wrong',
                'type'    => get_class($e),
            ], 500);

        });
    })->create();
