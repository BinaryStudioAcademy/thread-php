<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Entity\Tweet;
use App\Http\Presenter\Tweet\TweetArrayPresenter;
use Illuminate\Support\Facades\App;

class TweetAddedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = App::make(TweetArrayPresenter::class)->present($tweet);
    }

    public function broadcastAs(): string
    {
        return 'tweet.added';
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('tweets');
    }
}
