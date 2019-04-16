<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class CommentRepository implements Paginable
{
    public function paginate(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return Comment::orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }
}