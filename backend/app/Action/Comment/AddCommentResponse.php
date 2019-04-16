<?php

declare(strict_types=1);

namespace App\Action\Comment;

final class AddCommentResponse
{
    private $commentId;

    public function __construct(int $commentId)
    {
        $this->commentId = $commentId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }
}
