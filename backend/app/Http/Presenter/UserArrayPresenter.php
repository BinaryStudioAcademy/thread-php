<?php

declare(strict_types = 1);

namespace App\Http\Presenter;

use App\Entity\User;
use Illuminate\Support\Collection;

final class UserArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
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
