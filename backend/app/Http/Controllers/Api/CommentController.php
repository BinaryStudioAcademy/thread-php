<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Comment\AddCommentAction;
use App\Action\Comment\AddCommentRequest;
use App\Action\Comment\GetCommentByIdAction;
use App\Action\Comment\GetCommentCollectionAction;
use App\Action\Comment\GetCommentCollectionByTweetIdAction;
use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\CommentAsArrayPresenter;
use App\Http\Request\Api\AddCommentHttpRequest;
use App\Http\Response\ApiResponse;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Action\Comment\GetCommentCollectionByTweetIdRequest;

final class CommentController extends ApiController
{
    public function getCommentCollection(
        CollectionHttpRequest $request,
        GetCommentCollectionAction $action,
        CommentAsArrayPresenter $presenter,
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

    public function getCommentById(
        GetCommentByIdAction $action,
        CommentAsArrayPresenter $presenter,
        string $id,
    ): ApiResponse {
        $comment = $action->execute(new GetByIdRequest((int) $id))->getComment();

        return $this->createSuccessResponse($presenter->present($comment));
    }

    public function newComment(
        AddCommentHttpRequest $request,
        AddCommentAction $action,
        CommentAsArrayPresenter $presenter,
    ): ApiResponse {
        $response = $action->execute(
            new AddCommentRequest(
                $request->get('body'),
                (int)$request->get('tweet_id')
            )
        );

        return $this->created(
            $presenter->present(
                $response->getComment()
            )
        );
    }

    public function getCommentCollectionByTweetId(
        CollectionHttpRequest $request,
        GetCommentCollectionByTweetIdAction $action,
        CommentAsArrayPresenter $presenter,
        string $tweetId,
    ): ApiResponse {
        $response = $action->execute(
            new GetCommentCollectionByTweetIdRequest(
                (int) $tweetId,
                (int) $request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $presenter);
    }
}
