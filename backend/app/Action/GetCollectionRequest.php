<?php

declare(strict_types=1);

namespace App\Action;

class GetCollectionRequest
{
    private $page;
    private $sort;
    private $direction;

    public function __construct(?int $page, ?string $sort, ?string $direction)
    {
        $this->page = $page;
        $this->sort = $sort;
        $this->direction = $direction;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }
}
