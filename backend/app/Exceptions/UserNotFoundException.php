<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class UserNotFoundException extends \DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('User not found.', $code, $previous);
    }
}
