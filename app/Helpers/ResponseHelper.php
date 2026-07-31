<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResponseHelper
{
    public static function success(
        string $message = 'Success',
        mixed $data = null,
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function paginated(
        string $message,
        LengthAwarePaginator $pagination,
        AnonymousResourceCollection $resource,
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $resource->collection,
            'pagination' => [
                'current_page' => $pagination->currentPage(),
                'last_page' => $pagination->lastPage(),
                'per_page' => $pagination->perPage(),
                'total' => $pagination->total(),
                'from' => $pagination->firstItem(),
                'to' => $pagination->lastItem(),
                'has_more_pages' => $pagination->hasMorePages(),
            ],
        ], $status);
    }

    public static function error(
        string $message = 'Error',
        mixed $errors = null,
        int $status = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
