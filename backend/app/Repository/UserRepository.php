<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class UserRepository implements Paginable
{
    public function create(array $fields): User
    {
        return User::create($fields);
    }

    public function paginate(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return User::query()->orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }
}