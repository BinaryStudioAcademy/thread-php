<?php

declare(strict_types=1);

namespace App\Http\Request\Api\Auth;

use App\Http\Request\ApiFormRequest;

final class UploadProfileImageHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|image'
        ];
    }
}
