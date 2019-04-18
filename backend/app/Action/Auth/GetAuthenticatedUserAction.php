<?php

declare(strict_types = 1);

namespace App\Action\Auth;

use Illuminate\Support\Facades\Auth;

final class GetAuthenticatedUserAction
{
    public function execute(): GetAuthenticatedUserResponse
    {
        return new GetAuthenticatedUserResponse(Auth::user());
    }
}