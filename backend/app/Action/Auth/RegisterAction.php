<?php

declare(strict_types = 1);

namespace App\Action\Auth;

use App\Repository\UserRepository;
use Illuminate\Mail\Mailer;
use App\Mail\WelcomeEmail;

final class RegisterAction
{
    private $userRepository;
    private $mailer;

    public function __construct(UserRepository $userRepository, Mailer $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
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

        $this->mailer->to($user)->send(new WelcomeEmail());

        return new AuthenticationResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 60
        );
    }
}
