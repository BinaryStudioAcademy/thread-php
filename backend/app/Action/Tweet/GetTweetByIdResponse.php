<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Entity\Tweet;

final class GetTweetByIdResponse
{
    private $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function getTweet(): Tweet
    {
        return $this->tweet;
    }
}