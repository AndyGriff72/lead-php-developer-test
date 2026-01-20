<?php

namespace App\Services;

class ApiResponseFormatterService {
    public function __construct() {
    }

    /**
     * Return API responses in a standard format across the application.
     *
     * @param int $status HTTP status of the request.
     * @param array $data The data to return with the response.
     * @param string $message Any relevant error or status message.
     */
    public function formatResponse(int $status, array $data, string $message = ''): array {
        return [
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ];
    }
}
