<?php

declare(strict_types = 1);

namespace App\Http\Presenter;

use App\Entity\Tweet;
use Illuminate\Support\Collection;

final class TweetArrayPresenter implements CollectionAsArrayPresenter
{
    private $userPresenter;
    private $likeArrayPresenter;

    public function __construct(UserArrayPresenter $userPresenter, LikeArrayPresenter $likeArrayPresenter)
    {
        $this->userPresenter = $userPresenter;
        $this->likeArrayPresenter = $likeArrayPresenter;
    }

    public function present(Tweet $tweet): array
    {
        return [
            'id' => $tweet->getId(),
            'text' => $tweet->getText(),
            'image_url' => $tweet->getImageUrl(),
            'created_at' => $tweet->getCreatedAt()->toDateTimeString(),
            'author' => $this->userPresenter->present($tweet->getAuthor()),
            'comments_count' => $tweet->getCommentsCount(),
            'likes_count' => $tweet->getLikesCount(),
            'likes' => $this->likeArrayPresenter->presentCollection($tweet->likes)
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Tweet $tweet) {
                    return $this->present($tweet);
                }
            )
            ->all();
    }
}
