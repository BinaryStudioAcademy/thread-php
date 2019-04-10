<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Action\User\GetUserByIdAction;
use App\Action\User\GetUserCollectionAction;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\User\UserArrayPresenter;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Http\Response\ApiResponse;

final class UserController extends ApiController
{
    private $getUserCollectionAction;
    private $presenter;
    private $getUserByIdAction;

    public function __construct(
        GetUserCollectionAction $getUserCollectionAction,
        UserArrayPresenter $presenter,
        GetUserByIdAction $getUserByIdAction
    ) {
        $this->getUserCollectionAction = $getUserCollectionAction;
        $this->presenter = $presenter;
        $this->getUserByIdAction = $getUserByIdAction;
    }

    public function getUserCollection(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getUserCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function getUserById(string $id): ApiResponse
    {
        $user = $this->getUserByIdAction->execute(new GetByIdRequest((int)$id))->getUser();

        return $this->createSuccessResponse($this->presenter->present($user));
    }
}
