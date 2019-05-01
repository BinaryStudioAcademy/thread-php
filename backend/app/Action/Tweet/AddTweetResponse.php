<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class AddTweetResponse
{
    private $tweetId;

    public function __construct(int $tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function getTweetId(): int
    {
        return $this->tweetId;
    }
}
