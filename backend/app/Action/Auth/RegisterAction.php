<?php

declare(strict_types = 1);

namespace App\Action\Auth;

use App\Repository\UserRepository;

final class RegisterAction
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterRequest $request): AuthenticationResponse
    {
        $user = $this->userRepository->create([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
            'nickname' => $request->getNickname()
        ]);

        $token = auth()->login($user);

        return new AuthenticationResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 60
        );
    }
}