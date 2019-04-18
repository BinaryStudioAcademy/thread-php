<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Entity\Tweet;
use App\Repository\TweetRepository;
use Illuminate\Support\Facades\Auth;

final class AddTweetAction
{
    private $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function execute(AddTweetRequest $request): GetTweetByIdResponse
    {
        $tweet = new Tweet();
        $tweet->author_id = Auth::id();
        $tweet->text = $request->getText();
        $tweet->image_url = $request->getImageUrl();

        $tweet = $this->tweetRepository->save($tweet);

        return new GetTweetByIdResponse($tweet);
    }
}