<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Action\Tweet\AddTweetAction;
use App\Action\Tweet\AddTweetRequest;
use App\Action\Tweet\DeleteTweetAction;
use App\Action\Tweet\DeleteTweetRequest;
use App\Action\Tweet\GetTweetByIdAction;
use App\Action\Tweet\GetTweetCollectionAction;
use App\Action\Tweet\GetTweetCollectionByUserIdAction;
use App\Action\Tweet\GetTweetCollectionByUserIdRequest;
use App\Action\Tweet\UpdateTweetAction;
use App\Action\Tweet\UpdateTweetRequest;
use App\Action\Tweet\UploadTweetImageAction;
use App\Action\Tweet\UploadTweetImageRequest;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\TweetArrayPresenter;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Http\Request\Api\Tweet\AddTweetHttpRequest;
use App\Http\Request\Api\Tweet\UpdateTweetHttpRequest;
use App\Http\Request\Api\Tweet\UploadTweetImageHttpRequest;
use App\Http\Response\ApiResponse;

final class TweetController extends ApiController
{
    public function getTweetCollection(
        CollectionHttpRequest $request,
        GetTweetCollectionAction $action,
        TweetArrayPresenter $presenter,
    ): ApiResponse {
        $response = $action->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $presenter);
    }

    public function getTweetById(
        GetTweetByIdAction $action,
        TweetArrayPresenter $presenter,
        string $id
    ): ApiResponse {
        $tweet = $action->execute(new GetByIdRequest((int)$id))->getTweet();

        return $this->createSuccessResponse($presenter->present($tweet));
    }

    public function getTweetCollectionByUserId(
        CollectionHttpRequest $request,
        GetTweetCollectionByUserIdAction $action,
        TweetArrayPresenter $presenter,
        string $userId,
    ): ApiResponse {
        $response = $action->execute(
            new GetTweetCollectionByUserIdRequest(
                (int)$userId,
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $presenter);
    }

    public function addTweet(
        AddTweetHttpRequest $request,
        AddTweetAction $action,
        TweetArrayPresenter $presenter,
    ): ApiResponse {
        $response = $action->execute(
            new AddTweetRequest(
                $request->get('text')
            )
        );

        return $this->created($presenter->present($response->getTweet()));
    }

    public function updateTweetById(
        UpdateTweetHttpRequest $request,
        UpdateTweetAction $action,
        TweetArrayPresenter $presenter,
        string $id,
    ): ApiResponse {
        $response = $action->execute(
            new UpdateTweetRequest(
                (int)$id,
                $request->get('text')
            )
        );

        return $this->createSuccessResponse(
            $presenter->present(
                $response->getTweet()
            )
        );
    }

    public function uploadTweetImage(
        UploadTweetImageHttpRequest $request,
        UploadTweetImageAction $action,
        TweetArrayPresenter $presenter,
        string $id,
    ): ApiResponse {
        $response = $action->execute(
            new UploadTweetImageRequest(
                (int)$id,
                $request->file('image')
            )
        );

        return $this->createSuccessResponse(
            $presenter->present(
                $response->getTweet()
            )
        );
    }

    public function deleteTweetById(
        DeleteTweetAction $action,
        string $id
    ): ApiResponse {
        $action->execute(
            new DeleteTweetRequest(
                (int)$id
            )
        );

        return $this->createDeletedResponse();
    }
}
