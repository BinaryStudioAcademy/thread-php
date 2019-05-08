<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CommentRepository implements Paginable
{
    /**
     * @param int $id
     * @return Comment
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    public function paginate(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return Comment::orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    public function getPaginatedByTweetId(
        int $tweetId,
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return Comment::where('tweet_id', $tweetId)
            ->orderBy($sort, $direction)
            ->paginate($perPage, ['*'], null, $page);
    }

    public function save(Comment $comment): Comment
    {
        $comment->save();

        return $comment;
    }
}
