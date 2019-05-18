<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use App\Entity\Like;
use Illuminate\Support\Collection;

final class LikeArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(Like $like): array
    {
        return [
            'user_id' => $like->getUserId(),
            'created_at' => $like->getCreatedAt()->toDateTimeString()
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Like $like) {
                    return $this->present($like);
                }
            )
            ->all();
    }
}
