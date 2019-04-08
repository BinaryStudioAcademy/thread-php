<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;

final class UserController extends ApiController
{
    public function getUserCollection(Request $request): ApiResponse
    {
        return $this->createSuccessResponse();
    }
}
