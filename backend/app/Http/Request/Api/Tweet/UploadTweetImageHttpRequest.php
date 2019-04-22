<?php

declare(strict_types=1);

namespace App\Http\Request\Api\Tweet;

use App\Http\Request\ApiFormRequest;

final class UploadTweetImageHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|image'
        ];
    }
}
