<?php

declare(strict_types = 1);

namespace App\Action\Auth;

final class UpdateProfileRequest
{
    private $email;
//    private $password;
//    private $newPassword;
    private $name;
    private $nickname;

    public function __construct(
        ?string $email,
//        ?string $password,
//        ?string $newPassword,
        ?string $name,
        ?string $nickname
    ) {
        $this->email = $email;
//        $this->password = $password;
//        $this->newPassword = $newPassword;
        $this->name = $name;
        $this->nickname = $nickname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

//    public function getPassword(): ?string
//    {
//        return $this->password;
//    }
//
//    public function getNewPassword(): ?string
//    {
//        return $this->newPassword;
//    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }
}