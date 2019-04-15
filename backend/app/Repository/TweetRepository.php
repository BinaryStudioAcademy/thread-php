<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Tweet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class TweetRepository implements Paginable
{
    public function create(array $fields): Tweet
    {
        return Tweet::create($fields);
    }

    public function paginate(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return Tweet::orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    /**
     * @param int $id
     * @return Tweet
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Tweet
    {
        return Tweet::findOrFail($id);
    }
}
