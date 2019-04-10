<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Action\GetByIdRequest;
use App\Repository\UserRepository;

final class GetUserByIdAction
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetByIdRequest $request): GetUserByIdResponse
    {
        $user = $this->repository->getById($request->getId());

        return new GetUserByIdResponse($user);
    }
}