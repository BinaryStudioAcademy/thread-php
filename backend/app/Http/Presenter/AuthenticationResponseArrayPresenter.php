<?php

declare(strict_types = 1);

namespace App\Http\Presenter;

use App\Action\Auth\AuthenticationResponse;

final class AuthenticationResponseArrayPresenter
{
    public function present(AuthenticationResponse $response): array
    {
        return [
            'access_token' => $response->getAccessToken(),
            'token_type' => $response->getTokenType(),
            'expires_in' => $response->getExpiresIn()
        ];
    }
}
