<?php

namespace App\Exceptions;

use App\Http\Response\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        if (
            $this->shouldReport($exception)
            && Config::get('app.env') === 'production'
            && app()->bound('sentry')
        ) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $exception
     * @return Response|JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return ApiResponse::error(
                ErrorCode::VALIDATION_FAILED,
                $exception->validator->errors()->first()
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return ApiResponse::error(
                ErrorCode::HTTP_METHOD_NOT_ALLOWED,
                'Http method not allowed.'
            );
        }

        if ($exception instanceof AuthorizationException) {
            return ApiResponse::forbidden(
                'Forbidden.'
            );
        }

        if ($exception instanceof AuthenticationException) {
            return ApiResponse::unauthenticated();
        }

        // NotFoundHttpException - route doesn't exist
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            return ApiResponse::notFound('Resource not found.');
        }

        // if our custom application logic error occurred
        if ($exception instanceof \DomainException) {
            return ApiResponse::error(ErrorCode::VALIDATION_FAILED, $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
