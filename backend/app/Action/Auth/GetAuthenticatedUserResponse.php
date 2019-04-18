<?php

declare(strict_types = 1);

namespace App\Action\Auth;

use App\Entity\User;

final class GetAuthenticatedUserResponse
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}