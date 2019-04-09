<?php

declare(strict_types=1);

namespace App\Exceptions;

interface DomainExceptionInterface
{
    public function getErrorCode(): string;
}
