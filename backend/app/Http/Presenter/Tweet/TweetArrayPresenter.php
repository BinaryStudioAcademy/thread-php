<?php

declare(strict_types = 1);

namespace App\Http\Presenter\Tweet;

use App\Entity\Tweet;
use App\Http\Presenter\CollectionAsArrayPresenter;
use Illuminate\Support\Collection;

final class TweetArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(Tweet $tweet): array
    {
        return [
            'id' => $tweet->getId(),
            'text' => $tweet->getText(),
            'image_url' => $tweet->getImageUrl(),
            'created_at' => $tweet->getCreatedAt(),
            'author_id' => $tweet->getAuthorId(),
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