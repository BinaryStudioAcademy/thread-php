<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Models\Tweet;
use App\Repository\TweetRepository;
use Illuminate\Support\Facades\Auth;
use App\Events\TweetAddedEvent;

final class AddTweetAction
{
    public function __construct(private TweetRepository $tweetRepository)
    {
    }

    public function execute(AddTweetRequest $request): AddTweetResponse
    {
        $tweet = new Tweet();
        $tweet->author_id = Auth::id();
        $tweet->text = $request->getText();

        $tweet = $this->tweetRepository->save($tweet);

        broadcast(new TweetAddedEvent($tweet))->toOthers();

        return new AddTweetResponse($tweet);
    }
}
