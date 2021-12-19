<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Action\GetCollectionRequest;

final class GetCommentCollectionByTweetIdRequest extends GetCollectionRequest
{
    public function __construct(
        private int $tweetId,
        ?int $page,
        ?string $sort,
        ?string $direction
    ) {
        parent::__construct($page, $sort, $direction);
    }

    public function getTweetId(): int
    {
        return $this->tweetId;
    }
}
