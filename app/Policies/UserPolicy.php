<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Admins can view all users.
     */
    public function viewAny(User $auth): bool {
        return $auth->type === 'admin';
    }

    /**
     * Users can view themselves; admins can view anyone.
     */
    public function view(User $auth, User $target): bool {
        return $auth->type === 'admin'
            || $auth->id === $target->id;
    }

    /**
     * Anyone can create a user (registration).
     */
    public function create(?User $auth): bool {
        return true;
    }

    /**
     * Users can update themselves; admins can update anyone.
     */
    public function update(User $auth, User $target): bool {
        return $auth->type === 'admin'
            || $auth->id === $target->id;
    }

    /**
     * Only admins may delete users.
     */
    public function delete(User $auth, User $target): bool {
        return $auth->type === 'admin';
    }
}
