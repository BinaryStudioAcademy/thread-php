<?php

namespace App\Exceptions;

use App\Http\Response\ApiResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response|JsonResponse
     */
    public function render($request, Exception $exception)
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
