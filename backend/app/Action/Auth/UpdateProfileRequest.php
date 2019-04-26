<?php

declare(strict_types = 1);

namespace App\Action\Auth;

final class UpdateProfileRequest
{
    private $email;
    private $name;
    private $nickname;

    public function __construct(
        ?string $email,
        ?string $name,
        ?string $nickname
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->nickname = $nickname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }
}