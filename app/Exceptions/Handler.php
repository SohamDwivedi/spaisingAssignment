<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        // hook custom reporting here if needed.
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            if ($e instanceof ValidationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation failed',
                    'errors'  => $e->errors(),
                ], 422);
            }

            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unauthenticated',
                ], 401);
            }

            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Resource not found',
                ], 404);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Endpoint not found',
                ], 404);
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Invalid HTTP method',
                ], 405);
            }

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage() ?: 'Something went wrong',
                'type'    => class_basename($e),
                'file'    => config('app.debug') ? $e->getFile() : null,
                'line'    => config('app.debug') ? $e->getLine() : null,
            ], 500);
        }

        return parent::render($request, $e);
    }
}
