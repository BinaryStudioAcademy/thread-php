<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Action\GetCollectionRequest;
use App\Action\PaginatedResponse;
use App\Repository\UserRepository;

final class GetUserCollectionAction
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCollectionRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->repository->paginate(
                $request->getPage() ?: UserRepository::DEFAULT_PAGE,
                UserRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: UserRepository::DEFAULT_SORT,
                $request->getDirection() ?: UserRepository::DEFAULT_DIRECTION
            )
        );
    }
}