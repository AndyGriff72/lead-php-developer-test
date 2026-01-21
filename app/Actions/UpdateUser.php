<?php

namespace App\Actions;

use App\Models\User;

class UpdateUser {
    /**
     * Update a user with specified request data.
     *
     * @param User $user The user to update.
     * @param array $requestData The data with which to update the user record.
     * @return bool Returns true if successful, false if not.
     */
    public function execute(User $user, array $requestData): bool {
        return $user->update($requestData);
    }
}
