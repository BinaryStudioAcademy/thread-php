<?php

namespace App\Actions\Auth;

use App\Requests\Auth\LoginRequest;
use App\Responses\Auth\AuthenticateResponse;
use App\User;

class LoginAction
{
    public function execute(LoginRequest $request)
    {
        $token = auth()->attempt([
            'email' => $request->getEmail(),
            'password' => $request->getPassword()
        ]);

        if (!$token) {
            return $this->createErrorResponse('Unauthorized', 401);
        }

        return new AuthenticateResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 60
        );
    }
}