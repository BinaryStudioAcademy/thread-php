<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Action\GetCollectionRequest;

final class GetTweetCollectionByUserIdRequest extends GetCollectionRequest
{
    private $userId;

    public function __construct(int $userId, ?int $page, ?string $sort, ?string $direction)
    {
        GetCollectionRequest::__construct($page, $sort, $direction);

        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}