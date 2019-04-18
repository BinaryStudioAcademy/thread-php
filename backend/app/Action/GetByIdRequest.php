<?php

declare(strict_types=1);

namespace App\Action;

final class GetByIdRequest
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
