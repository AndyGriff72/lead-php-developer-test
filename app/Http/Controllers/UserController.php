<?php

namespace App\Http\Controllers;

use App\Services\ApiResponseFormatterService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return a summary of all users.
     *
     * @return array Returns an associative array with status, data and message elements.
     */
    public function index(): array {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Return a single user record.
     *
     * @param int $userId The ID of the user to retrieve.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function show(int $userId): array {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Store a new user record in the database.
     *
     * @param Request $request The API request body containing new data.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function store(Request $request): array {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Update a single user record in the database.
     *
     * @param Request $request The API request body.
     * @param int $userId The ID of the user to update.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function update(Request $request, int $userId): array {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Soft-delete a record from the database.
     *
     * @param Request $request The API request body.
     * @param int $userId The ID of the user to delete.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function destroy(Request $request, int $userId): array {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }
}
