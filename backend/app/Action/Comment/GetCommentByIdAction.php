<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\GetByIdRequest;
use App\Repository\CommentRepository;

final class GetCommentByIdAction
{
    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetByIdRequest $request): GetCommentByIdResponse
    {
        $comment = $this->repository->getById($request->getId());

        return new GetCommentByIdResponse($comment);
    }
}