<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\GetByIdRequest;
use App\Repository\CommentRepository;

final class GetCommentByIdAction
{
    public function __construct(private CommentRepository $commentRepository)
    {
    }

    public function execute(GetByIdRequest $request): GetCommentByIdResponse
    {
        $comment = $this->commentRepository->getById($request->getId());

        return new GetCommentByIdResponse($comment);
    }
}
