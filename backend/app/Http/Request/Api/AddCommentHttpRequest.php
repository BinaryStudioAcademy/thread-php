<?php

declare(strict_types=1);

namespace App\Http\Request\Api;

use App\Http\Request\ApiFormRequest;

final class AddCommentHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'body' => 'required',
            'tweet_id' => 'required|integer',
        ];
    }
}