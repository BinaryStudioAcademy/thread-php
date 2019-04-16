<?php

declare(strict_types=1);

namespace App\Action\Comment;

final class AddCommentRequest
{
    private $body;
    private $tweetId;

    public function __construct(string $body, int $tweetId)
    {
        $this->body = $body;
        $this->tweetId = $tweetId;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getTweetId(): int
    {
        return $this->tweetId;
    }
}
