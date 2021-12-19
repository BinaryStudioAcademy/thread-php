<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Presenter\CollectionAsArrayPresenter;
use App\Http\Response\ApiResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Collection;

abstract class ApiController extends Controller
{
    final protected function createSuccessResponse(array $data = []): ApiResponse
    {
        return ApiResponse::success($data);
    }

    final protected function createErrorResponse(string $message, string $code): ApiResponse
    {
        return ApiResponse::error($code, $message);
    }

    final protected function createDeletedResponse(): ApiResponse
    {
        return ApiResponse::deleted();
    }

    final protected function createEmptyResponse(): ApiResponse
    {
        return ApiResponse::empty();
    }

    final protected function createPaginatedResponse(
        LengthAwarePaginator $paginator,
        CollectionAsArrayPresenter $presenter
    ): ApiResponse {
        return ApiResponse::paginate(
            new Paginator(
                $presenter->presentCollection(Collection::make($paginator->items())),
                $paginator->total(),
                $paginator->perPage(),
                $paginator->currentPage()
            )
        );
    }

    final protected function created(array $data): ApiResponse
    {
        return ApiResponse::created($data);
    }
}
