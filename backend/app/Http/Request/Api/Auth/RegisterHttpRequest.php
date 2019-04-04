<?php

declare(strict_types = 1);

namespace App\Http\Request\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterHttpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6|string',
            'name' => 'required|string',
        ];
    }
}
