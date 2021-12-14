<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Action\GetByIdRequest;
use App\Repository\UserRepository;

final class GetUserByIdAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(GetByIdRequest $request): GetUserByIdResponse
    {
        $user = $this->userRepository->getById($request->getId());

        return new GetUserByIdResponse($user);
    }
}
