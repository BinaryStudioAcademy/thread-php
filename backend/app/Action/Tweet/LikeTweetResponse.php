<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class LikeTweetResponse
{
    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
