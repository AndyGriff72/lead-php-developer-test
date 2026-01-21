<?php

namespace App\Actions;

use App\Models\User;

class DeleteUser
{
    /**
     * Delete a user from the database.
     *
     * @param User $user The user to remove from the database.
     * @return bool Returns true if successful, false if not.
     */
    public function execute(User $user): bool
    {
        return $user->delete();
    }
}
