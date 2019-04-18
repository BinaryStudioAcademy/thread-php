<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Action\Tweet\AddTweetAction;
use App\Action\Tweet\AddTweetRequest;
use App\Action\Tweet\GetTweetByIdAction;
use App\Action\Tweet\GetTweetCollectionAction;
use App\Action\Tweet\GetTweetCollectionByUserIdAction;
use App\Action\Tweet\GetTweetCollectionByUserIdRequest;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\Tweet\TweetArrayPresenter;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Http\Request\Api\Tweet\AddTweetHttpRequest;
use App\Http\Response\ApiResponse;

final class TweetController extends ApiController
{
    private $getTweetCollectionAction;
    private $presenter;
    private $getTweetByIdAction;
    private $getTweetCollectionByUserIdAction;
    private $addTweetAction;

    public function __construct(
        GetTweetCollectionAction $getTweetCollectionAction,
        TweetArrayPresenter $presenter,
        GetTweetByIdAction $getTweetByIdAction,
        GetTweetCollectionByUserIdAction $getTweetCollectionByUserIdAction,
        AddTweetAction $addTweetAction
    ) {
        $this->getTweetCollectionAction = $getTweetCollectionAction;
        $this->presenter = $presenter;
        $this->getTweetByIdAction = $getTweetByIdAction;
        $this->getTweetCollectionByUserIdAction = $getTweetCollectionByUserIdAction;
        $this->addTweetAction = $addTweetAction;
    }

    public function getTweetCollection(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getTweetCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function getTweetById(string $id): ApiResponse
    {
        $tweet = $this->getTweetByIdAction->execute(new GetByIdRequest((int)$id))->getTweet();

        return $this->createSuccessResponse($this->presenter->present($tweet));
    }

    public function getTweetCollectionByUserId(string $userId, CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getTweetCollectionByUserIdAction->execute(
            new GetTweetCollectionByUserIdRequest(
                (int)$userId,
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function addTweet(AddTweetHttpRequest $request): ApiResponse
    {
        $response = $this->addTweetAction->execute(
            new AddTweetRequest(
                $request->get('text'),
                $request->get('image_url')
            )
        );

        return $this->createSuccessResponse(
            $this->presenter->present(
                $response->getTweet()
            )
        );
    }
}
