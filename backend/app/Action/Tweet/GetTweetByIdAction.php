<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\GetByIdRequest;
use App\Repository\TweetRepository;

final class GetTweetByIdAction
{
    private $repository;

    public function __construct(TweetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetByIdRequest $request): GetTweetByIdResponse
    {
        $tweet = $this->repository->getById($request->getId());

        return new GetTweetByIdResponse($tweet);
    }
}