<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Entity\Comment;

final class AddCommentResponse
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
