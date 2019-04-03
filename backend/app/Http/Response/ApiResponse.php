<?php

declare(strict_types = 1);

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

final class ApiResponse extends JsonResponse
{
    private const CLIENT_ERROR_STATUS = 400;
    private const RESOURCE_DELETED_STATUS = 204;
    private const RESOURCE_NOT_FOUND_STATUS = 404;

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
        return new static($data);
    }

    public static function empty(): self
    {
        return new static();
    }

    public static function deleted(): self
    {
        return new static(null, self::RESOURCE_DELETED_STATUS);
    }

    public static function notFound(string $code, string $message): self
    {
        static::assertErrorDataIsValid($code, $message);

        return new static([
            'errors' => [
                [
                    'code' => $code,
                    'message' => $message
                ]
            ]
        ], self::RESOURCE_NOT_FOUND_STATUS);
    }

    private static function assertErrorDataIsValid(string $code, string $message): void
    {
        if (empty($code) || empty($message)) {
            throw new \InvalidArgumentException();
        }
    }
}
