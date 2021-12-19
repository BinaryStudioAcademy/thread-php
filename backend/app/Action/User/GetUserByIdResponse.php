<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Models\User;

final class GetUserByIdResponse
{
    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
