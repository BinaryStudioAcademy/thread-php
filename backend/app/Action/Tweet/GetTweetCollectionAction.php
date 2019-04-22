<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\GetCollectionRequest;
use App\Repository\TweetRepository;
use App\Action\PaginatedResponse;

final class GetTweetCollectionAction
{
    private $repository;

    public function __construct(TweetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCollectionRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->repository->paginate(
                $request->getPage() ?: TweetRepository::DEFAULT_PAGE,
                TweetRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: TweetRepository::DEFAULT_SORT,
                $request->getDirection() ?: TweetRepository::DEFAULT_DIRECTION
            )
        );
    }
}
