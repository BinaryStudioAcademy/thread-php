<?php

declare(strict_types=1);

namespace App\Action\Comment;

final class AddCommentRequest
{
    private $authorId;
    private $body;
    private $tweetId;

    public function __construct(int $authorId, string $body, int $tweetId)
    {
        $this->authorId = $authorId;
        $this->body = $body;
        $this->tweetId = $tweetId;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
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
