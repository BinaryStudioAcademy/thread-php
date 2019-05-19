<?php

declare(strict_types = 1);

namespace App\Action\Auth;

final class UpdateProfileRequest
{
    private $email;
    private $firstName;
    private $lastName;
    private $nickname;

    public function __construct(
        ?string $email,
        ?string $firstName,
        ?string $lastName,
        ?string $nickname
    ) {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->nickname = $nickname;
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