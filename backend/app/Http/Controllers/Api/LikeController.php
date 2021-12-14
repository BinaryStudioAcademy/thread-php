<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Tweet\LikeTweetAction;
use App\Action\Tweet\LikeTweetRequest;
use App\Http\Controllers\ApiController;
use App\Http\Response\ApiResponse;

final class LikeController extends ApiController
{
    public function likeOrDislikeTweet(
        LikeTweetAction $action,
        string $id
    ): ApiResponse {
        $response = $action->execute(new LikeTweetRequest((int)$id));

        return $this->createSuccessResponse(['status' => $response->getStatus()]);
    }
}
