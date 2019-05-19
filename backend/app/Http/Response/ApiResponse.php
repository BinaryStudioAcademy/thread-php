<?php

declare(strict_types = 1);

namespace App\Http\Response;

use App\Exceptions\ErrorCode;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

final class ApiResponse extends JsonResponse
{
    private const CLIENT_ERROR_STATUS = 400;
    private const NO_CONTENT_STATUS = 204;
    private const FORBIDDEN_STATUS = 403;
    private const RESOURCE_NOT_FOUND_STATUS = 404;
    private const RESOURCE_CREATED_STATUS = 201;
    private const UNAUTHENTICATED_STATUS = 401;

    public static function error(string $code, string $message): self
    {
        static::assertErrorDataIsValid($code, $message);

        return new static([
            'errors' => [
                [
                    'code' => $code,
                    'message' => $message
                ]
            ]
        ], self::CLIENT_ERROR_STATUS);
    }

    public static function success(array $data = []): self
    {
        return new static(['data' => $data]);
    }

    public static function empty(): self
    {
        return new static(null, self::NO_CONTENT_STATUS);
    }

    public static function deleted(): self
    {
        return new static(null, self::NO_CONTENT_STATUS);
    }

    public static function forbidden(string $message): self
    {
        return static::error(ErrorCode::FORBIDDEN, $message)->setStatusCode(self::FORBIDDEN_STATUS);
    }

    public static function unauthenticated(string $message = 'Unauthenticated.'): self
    {
        return static::error(ErrorCode::UNAUTHENTICATED, $message)->setStatusCode(self::UNAUTHENTICATED_STATUS);
    }

    public static function notFound(string $message): self
    {
        return static::error(ErrorCode::NOT_FOUND, $message)->setStatusCode(self::RESOURCE_NOT_FOUND_STATUS);
    }

    private static function assertErrorDataIsValid(string $code, string $message): void
    {
        if (empty($code) || empty($message)) {
            throw new InvalidArgumentException('Error values cannot be empty.');
        }
    }

    public static function paginate(LengthAwarePaginator $paginator): self
    {
        return new static([
            'data' => $paginator->items(),
            'meta' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
            ]
        ]);
    }

    public static function created(array $data): self
    {
        return new static(['data' => $data], self::RESOURCE_CREATED_STATUS);
    }
}
