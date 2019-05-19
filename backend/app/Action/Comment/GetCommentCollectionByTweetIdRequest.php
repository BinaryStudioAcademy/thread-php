<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\GetCollectionRequest;

final class GetCommentCollectionByTweetIdRequest extends GetCollectionRequest
{
    private $tweetId;

    public function __construct(int $tweetId, ?int $page, ?string $sort, ?string $direction)
    {
        parent::__construct($page, $sort, $direction);

        $this->tweetId = $tweetId;
    }

    public function getTweetId(): int
    {
        return $this->tweetId;
    }
}
