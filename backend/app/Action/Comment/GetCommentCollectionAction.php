<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\GetCollectionRequest;
use App\Action\PaginatedResponse;
use App\Repository\CommentRepository;

final class GetCommentCollectionAction
{
    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCollectionRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->repository->paginate(
                $request->getPage() ?: CommentRepository::DEFAULT_PAGE,
                CommentRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: CommentRepository::DEFAULT_SORT,
                $request->getDirection() ?: CommentRepository::DEFAULT_DIRECTION
            )
        );
    }
}