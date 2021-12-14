<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\GetByIdRequest;
use App\Action\GetCollectionRequest;
use App\Action\User\GetUserByIdAction;
use App\Action\User\GetUserCollectionAction;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\UserArrayPresenter;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Http\Response\ApiResponse;

final class UserController extends ApiController
{
    public function getUserCollection(
        CollectionHttpRequest $request,
        GetUserCollectionAction $action,
        UserArrayPresenter $presenter,
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

    public function getUserById(
        GetUserByIdAction $action,
        UserArrayPresenter $presenter,
        string $id,
    ): ApiResponse {
        $user = $action->execute(new GetByIdRequest((int)$id))->getUser();

        return $this->createSuccessResponse($presenter->present($user));
    }
}
