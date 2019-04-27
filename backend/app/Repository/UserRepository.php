<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return User::orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function save(User $user): User
    {
        $user->save();

        return $user;
    }
}