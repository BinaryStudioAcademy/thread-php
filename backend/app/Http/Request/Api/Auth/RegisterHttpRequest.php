<?php

declare(strict_types = 1);

namespace App\Http\Request\Api\Auth;

use App\Http\Request\ApiFormRequest;

final class RegisterHttpRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|string',
            'firstName' => 'required|string|min:2',
            'lastName' => 'required|string|min:2',
            'nickname' => 'required|string|min:2|unique:users'
        ];
    }
}
