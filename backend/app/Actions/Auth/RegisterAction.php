<?php

namespace App\Actions\Auth;

use App\Requests\Auth\RegisterRequest;
use App\Responses\Auth\AuthenticateResponse;
use App\User;

class RegisterAction
{
    public function execute(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
            'name' => $request->getName()
        ]);

        $token = auth()->login($user);

        return new AuthenticateResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 60
        );
    }
}