<?php

declare(strict_types = 1);

namespace App\Exceptions;

final class ErrorCode
{
    public const VALIDATION_FAILED = 'invalid_request';

    public const UNAUTHENTICATED = 'unauthenticated';

    public const HTTP_METHOD_NOT_ALLOWED = 'method_not_allowed';

    public const NOT_FOUND = 'not_found';

    public const FORBIDDEN = 'forbidden';
}