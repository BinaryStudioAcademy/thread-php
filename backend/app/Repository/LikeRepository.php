<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Like;
use App\Entity\Tweet;

final class LikeRepository
{
    public function save(Like $like): Like
    {
        $like->save();

        return $like;
    }

    public function existsForTweetByUser(int $tweetId, int $userId): bool
    {
        return Like::where([
            'likeable_id' => $tweetId,
            'likeable_type' => Tweet::class,
            'user_id' => $userId
        ])->exists();
    }

    public function deleteForTweetByUser(int $tweetId, int $userId): void
    {
        Like::where([
            'likeable_id' => $tweetId,
            'likeable_type' => Tweet::class,
            'user_id' => $userId
        ])->delete();
    }
}
