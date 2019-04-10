<?php

declare(strict_types = 1);

namespace App\Http\Presenter\User;

use App\Entity\User;
use App\Http\Presenter\CollectionAsArrayPresenter;
use Illuminate\Support\Collection;

final class UserArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'nickname' => $user->getNickName(),
            'avatar' => $user->getAvatar()
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (User $user) {
                    return $this->present($user);
                }
            )
            ->all();
    }
}