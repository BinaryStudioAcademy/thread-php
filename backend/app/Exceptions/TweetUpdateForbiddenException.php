<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final class TweetUpdateForbiddenException extends AccessDeniedHttpException
{
    public function __construct()
    {
        parent::__construct('You are not allowed to update this tweet.');
    }
}
