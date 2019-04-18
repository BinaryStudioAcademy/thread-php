<?php

declare(strict_types=1);

namespace App\Http\Request\Api;

use App\Http\Request\ApiFormRequest;
use Illuminate\Validation\Rule;

final class CollectionHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'sort' => 'string',
            'direction' => [
                'string',
                Rule::in(['asc', 'desc'])
            ]
        ];
    }
}