<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseFormatterService
{
    public function __construct()
    {
    }

    /**
     * Return API responses in a standard format across the application.
     *
     * @param int $status HTTP status of the request.
     * @param array $data The data to return with the response.
     * @param string $message Any relevant error or status message.
     * @return JsonResponse
     */
    public function formatResponse(int $status, ?array $data = [], ?string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}
