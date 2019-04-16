<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Comment\AddCommentAction;
use App\Action\Comment\AddCommentRequest;
use App\Action\Comment\GetCommentByIdAction;
use App\Action\Comment\GetCommentCollectionAction;
use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\Comment\CommentAsArrayPresenter;
use App\Http\Request\Api\AddCommentHttpRequest;
use App\Http\Response\ApiResponse;
use App\Http\Request\Api\CollectionHttpRequest;

final class CommentController extends ApiController
{
    private $getCommentCollectionAction;
    private $presenter;
    private $getCommentByIdAction;
    private $addCommentAction;

    public function __construct(
        GetCommentCollectionAction $getCommentCollectionAction,
        CommentAsArrayPresenter $presenter,
        GetCommentByIdAction $commentByIdAction,
        AddCommentAction $addCommentAction
    ) {
        $this->getCommentCollectionAction = $getCommentCollectionAction;
        $this->presenter = $presenter;
        $this->getCommentByIdAction = $commentByIdAction;
        $this->addCommentAction = $addCommentAction;
    }

    public function getCommentCollection(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getCommentCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function getCommentById(string $id): ApiResponse
    {
        $comment = $this->getCommentByIdAction->execute(new GetByIdRequest((int)$id))->getComment();

        return $this->createSuccessResponse($this->presenter->present($comment));
    }

    public function newComment(AddCommentHttpRequest $request): ApiResponse
    {
        $response = $this->addCommentAction->execute(
            new AddCommentRequest(
                $request->get('body'),
                (int)$request->get('tweet_id')
            )
        );

        return $this->created($response->getCommentId());
    }
}