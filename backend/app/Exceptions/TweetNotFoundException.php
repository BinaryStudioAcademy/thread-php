<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class TweetNotFoundException extends NotFoundHttpException
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct('Tweet not found.', $previous, $code);
    }
}
