<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\GetCollectionRequest;
use App\Action\User\GetUserCollectionAction;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\User\UserArrayPresenter;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Http\Response\ApiResponse;

final class UserController extends ApiController
{
    private $getUserCollectionAction;
    private $presenter;

    public function __construct(GetUserCollectionAction $getUserCollectionAction, UserArrayPresenter $presenter)
    {
        $this->getUserCollectionAction = $getUserCollectionAction;
        $this->presenter = $presenter;
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
}
