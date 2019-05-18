<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Entity\Like;
use App\Repository\LikeRepository;
use App\Repository\TweetRepository;
use Illuminate\Support\Facades\Auth;

final class LikeTweetAction
{
    private $tweetRepository;
    private $likeRepository;

    public function __construct(TweetRepository $tweetRepository, LikeRepository $likeRepository)
    {
        $this->tweetRepository = $tweetRepository;
        $this->likeRepository = $likeRepository;
    }

    public function execute(LikeTweetRequest $request): void
    {
        $tweet = $this->tweetRepository->getById($request->getTweetId());

        $userId = Auth::id();

        // if user already liked tweet, we remove previous like
        if ($this->likeRepository->existsForTweetByUser($tweet->id, $userId)) {
            $this->likeRepository->deleteForTweetByUser($tweet->id, $userId);

            return;
        }

        $like = new Like();
        $like->forTweet(Auth::id(), $tweet->id);

        $this->likeRepository->save($like);
    }
}
