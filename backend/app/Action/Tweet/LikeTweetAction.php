<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Models\Like;
use App\Repository\LikeRepository;
use App\Repository\TweetRepository;
use Illuminate\Support\Facades\Auth;

final class LikeTweetAction
{
    private const ADD_LIKE_STATUS = 'added';
    private const REMOVE_LIKE_STATUS = 'removed';

    public function __construct(
        private TweetRepository $tweetRepository,
        private LikeRepository $likeRepository,
    ) {
    }

    public function execute(LikeTweetRequest $request): LikeTweetResponse
    {
        $tweet = $this->tweetRepository->getById($request->getTweetId());

        $userId = Auth::id();

        // if user already liked tweet, we remove previous like
        if ($this->likeRepository->existsForTweetByUser($tweet->id, $userId)) {
            $this->likeRepository->deleteForTweetByUser($tweet->id, $userId);

            return new LikeTweetResponse(self::REMOVE_LIKE_STATUS);
        }

        $like = new Like();
        $like->forTweet(Auth::id(), $tweet->id);

        $this->likeRepository->save($like);

        return new LikeTweetResponse(self::ADD_LIKE_STATUS);
    }
}
