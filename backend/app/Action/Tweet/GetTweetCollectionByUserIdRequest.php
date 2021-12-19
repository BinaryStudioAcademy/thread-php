<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\GetCollectionRequest;

final class GetTweetCollectionByUserIdRequest extends GetCollectionRequest
{
    public function __construct(
        private int $userId,
        ?int $page,
        ?string $sort,
        ?string $direction
    ) {
        parent::__construct($page, $sort, $direction);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
