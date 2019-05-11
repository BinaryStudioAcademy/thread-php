<?php

declare(strict_types = 1);

namespace App\Action\Auth;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

final class UpdateProfileAction
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UpdateProfileRequest $request): UpdateProfileResponse
    {
        $user = Auth::user();

        $user->email = $request->getEmail() ?: $user->email;
        $user->first_name = $request->getFirstName() ?: $user->first_name;
        $user->last_name = $request->getLastName() ?: $user->last_name;
        $user->nickname = $request->getNickname() ?: $user->nickname;

        $user = $this->userRepository->save($user);

        return new UpdateProfileResponse($user);
    }
}