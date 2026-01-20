<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiResponseFormatterService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Constructor. Set up default authorizations for UserPolicy.
     */
    public function __construct() {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Return a summary of all users.
     *
     * @return JsonResponse Returns an associative array with status, data and message elements.
     */
    public function index(): JsonResponse {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Return a single user record.
     *
     * @param User $user The user to retrieve.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function show(User $user): JsonResponse {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Store a new user record in the database.
     *
     * @param Request $request The API request body containing new data.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function store(Request $request): JsonResponse {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Update a single user record in the database.
     *
     * @param Request $request The API request body.
     * @param User $user The user to update.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function update(Request $request, User $user): JsonResponse {
        return (new ApiResponseFormatterService())->formatResponse(200, []);
    }

    /**
     * Soft-delete a record from the database.
     *
     * @param Request $request The API request body.
     * @param User $userId The user to delete.
     * @return array Returns an associative array with status, data and message elements.
     */
    public function destroy(Request $request, User $user): JsonResponse {
        return (new ApiResponseFormatterService())->formatResponse(204, []);
    }
}
