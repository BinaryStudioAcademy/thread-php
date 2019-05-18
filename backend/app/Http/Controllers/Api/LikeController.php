<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Tweet\LikeTweetAction;
use App\Action\Tweet\LikeTweetRequest;
use App\Http\Controllers\ApiController;
use App\Http\Response\ApiResponse;

final class LikeController extends ApiController
{
    private $likeTweetAction;

    public function __construct(LikeTweetAction $likeTweetAction)
    {
        $this->likeTweetAction = $likeTweetAction;
    }

    public function likeOrDislikeTweet(string $id): ApiResponse
    {
        $this->likeTweetAction->execute(new LikeTweetRequest((int)$id));

        return $this->createEmptyResponse();
    }
}
