<?php

declare(strict_types=1);

namespace App\Action;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PaginatedResponse
{
    public function __construct(private LengthAwarePaginator $paginator)
    {
    }

    public function getPaginator(): LengthAwarePaginator
    {
        return $this->paginator;
    }
}
