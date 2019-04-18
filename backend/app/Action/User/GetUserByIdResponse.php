<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Entity\User;

final class GetUserByIdResponse
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