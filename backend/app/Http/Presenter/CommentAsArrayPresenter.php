<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use App\Entity\Comment;
use Illuminate\Support\Collection;

final class CommentAsArrayPresenter implements CollectionAsArrayPresenter
{
    private $userArrayPresenter;

    public function __construct(UserArrayPresenter $userArrayPresenter)
    {
        $this->userArrayPresenter = $userArrayPresenter;
    }

    public function present(Comment $comment): array
    {
        return [
            'id' => $comment->getId(),
            'body' => $comment->getBody(),
            'author_id' => $comment->getAuthorId(),
            'tweet_id' => $comment->getTweetId(),
            'created_at' => $comment->getCreatedAt()->toDateTimeString(),
            'updated_at' => $comment->getUpdatedAt() ? $comment->getUpdatedAt()->toDateTimeString() : null,
            'author' => $this->userArrayPresenter->present($comment->author)
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Comment $comment) {
                    return $this->present($comment);
                }
            )
            ->all();
    }
}
