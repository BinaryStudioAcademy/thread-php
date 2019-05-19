<?php

declare(strict_types = 1);

namespace App\Http\Request\Api\Auth;

use App\Http\Request\ApiFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'email' => [
                'email',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'first_name' => 'string|min:2',
            'last_name' => 'string|min:2',
            'nickname' => [
                'string',
                'min:2',
                Rule::unique('users')->ignore(Auth::id())
            ]
        ];
    }
}
