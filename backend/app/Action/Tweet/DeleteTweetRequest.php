<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class DeleteTweetRequest
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
