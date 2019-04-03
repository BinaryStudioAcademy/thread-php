<?php

namespace App\Presenters\Auth;

use App\Responses\Auth\AuthenticateResponse;

class AuthPresenter
{
    public function presentAuthenticateResponse(AuthenticateResponse $response): array
    {
        return [
            'access_token' => $response->getAccessToken(),
            'token_type' => $response->getTokenType(),
            'expires_in' => $response->getExpiresIn()
        ];
    }
}