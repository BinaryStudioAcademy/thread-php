<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\User;

final class UserRepository
{
    public function create(array $fields): User
    {
        return User::create($fields);
    }
}