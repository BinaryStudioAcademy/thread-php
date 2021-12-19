<?php

declare(strict_types = 1);

namespace App\Action\Auth;

final class UpdateProfileRequest
{
    public function __construct(
        private ?string $email,
        private ?string $firstName,
        private ?string $lastName,
        private ?string $nickname
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }
}
