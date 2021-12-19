<?php

declare(strict_types=1);

namespace App\Action\Comment;

final class AddCommentRequest
{
    public function __construct(private string $body, private int $tweetId)
    {
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
