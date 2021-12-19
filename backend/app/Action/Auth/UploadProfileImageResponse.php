<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Models\User;

final class UploadProfileImageResponse
{
    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
