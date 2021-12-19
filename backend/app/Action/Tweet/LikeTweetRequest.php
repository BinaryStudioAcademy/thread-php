<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class LikeTweetRequest
{
    public function __construct(private int $tweetId)
    {
    }

    public function getTweetId(): int
    {
        return $this->tweetId;
    }
}
