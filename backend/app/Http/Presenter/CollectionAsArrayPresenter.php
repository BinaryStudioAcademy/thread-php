<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Illuminate\Support\Collection;

interface CollectionAsArrayPresenter
{
    public function presentCollection(Collection $collection): array;
}