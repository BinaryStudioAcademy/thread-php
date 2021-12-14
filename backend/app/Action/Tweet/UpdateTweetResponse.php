<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Models\Tweet;

final class UpdateTweetResponse
{
    public function __construct(private Tweet $tweet)
    {
    }

    public function getTweet(): Tweet
    {
        return $this->tweet;
    }
}
