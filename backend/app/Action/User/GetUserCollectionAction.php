<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Action\GetCollectionRequest;
use App\Action\PaginatedResponse;
use App\Repository\UserRepository;

final class GetUserCollectionAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(GetCollectionRequest $request): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->userRepository->paginate(
                $request->getPage() ?: UserRepository::DEFAULT_PAGE,
                UserRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: UserRepository::DEFAULT_SORT,
                $request->getDirection() ?: UserRepository::DEFAULT_DIRECTION
            )
        );
    }
}
