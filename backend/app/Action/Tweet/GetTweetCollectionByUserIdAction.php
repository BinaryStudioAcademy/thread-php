<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\PaginatedResponse;
use App\Repository\TweetRepository;

final class GetTweetCollectionByUserIdAction
{
    private $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function execute(GetTweetCollectionByUserIdRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->tweetRepository->getPaginatedByUserId(
                $request->getUserId(),
                $request->getPage() ?: TweetRepository::DEFAULT_PAGE,
                TweetRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: TweetRepository::DEFAULT_SORT,
                $request->getDirection() ?: TweetRepository::DEFAULT_DIRECTION
            )
        );
    }
}