<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\GetByIdRequest;
use App\Repository\TweetRepository;

final class GetTweetByIdAction
{
    public function __construct(private TweetRepository $tweetRepository)
    {
    }

    public function execute(GetByIdRequest $request): GetTweetByIdResponse
    {
        $tweet = $this->tweetRepository->getById($request->getId());

        return new GetTweetByIdResponse($tweet);
    }
}
