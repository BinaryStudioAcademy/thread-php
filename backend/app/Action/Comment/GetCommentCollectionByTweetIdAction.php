<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\PaginatedResponse;
use App\Repository\CommentRepository;

final class GetCommentCollectionByTweetIdAction
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(GetCommentCollectionByTweetIdRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->commentRepository->getPaginatedByTweetId(
                $request->getTweetId(),
                $request->getPage() ?: CommentRepository::DEFAULT_PAGE,
                CommentRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: CommentRepository::DEFAULT_SORT,
                $request->getDirection() ?: CommentRepository::DEFAULT_DIRECTION
            )
        );
    }
}
