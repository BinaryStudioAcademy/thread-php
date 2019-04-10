<?php

declare(strict_types=1);

namespace App\Action\User;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class GetUserCollectionResponse
{
    private $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getPaginator(): LengthAwarePaginator
    {
        return $this->paginator;
    }
}