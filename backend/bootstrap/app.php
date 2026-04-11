<?php

use App\Http\Middleware\AssignRequestId;
use App\Support\ProblemResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [AssignRequestId::class]);
        $middleware->throttleApi(redis: false);
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return ProblemResponse::validation($request, $exception->errors());
        });

        $exceptions->render(function (AuthenticationException $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return ProblemResponse::make($request, Response::HTTP_UNAUTHORIZED, 'Authentication failed');
        });

        $exceptions->render(function (AuthorizationException $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return ProblemResponse::make($request, Response::HTTP_FORBIDDEN, 'Forbidden');
        });

        $exceptions->render(function (ModelNotFoundException $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return ProblemResponse::make($request, Response::HTTP_NOT_FOUND, 'Resource not found');
        });

        $exceptions->render(function (HttpExceptionInterface $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            return ProblemResponse::make(
                $request,
                $exception->getStatusCode(),
                Response::$statusTexts[$exception->getStatusCode()] ?? 'Request failed',
                $exception->getMessage() ?: null,
            );
        });

        $exceptions->render(function (Throwable $exception, $request) {
            if (! $request->is('api/*')) {
                return null;
            }

            report($exception);

            return ProblemResponse::make(
                $request,
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'Internal server error',
                app()->hasDebugModeEnabled() ? $exception->getMessage() : 'The server could not complete the request.',
            );
        });
    })->create();
