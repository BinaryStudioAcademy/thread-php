<?php

declare(strict_types = 1);

namespace App\Http\Request\Api\Auth;

use App\Http\Request\ApiFormRequest;

final class UpdateProfileHttpRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'email|unique:users',
            'name' => 'string|min:2',
            'nickname' => 'string|min:2|unique:users'
        ];
    }
}
