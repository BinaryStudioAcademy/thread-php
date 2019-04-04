<?php

declare(strict_types = 1);

namespace App\Http\Presenter\User;

use App\Entity\User;

final class UserArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name
        ];
    }
}