<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Models\Comment;

final class GetCommentByIdResponse
{
    public function __construct(private Comment $comment)
    {
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
