<?php

namespace App\Actions;

use App\Models\User;

class CreateUser {
    public function execute(array $requestData): User {
        return User::create($requestData);
    }
}
