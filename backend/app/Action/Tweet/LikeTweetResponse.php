<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class LikeTweetResponse
{
    public function __construct(private string $status)
    {
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
