<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateUser;
use App\Actions\UpdateUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that CreateUser creates a user and that the user subsequently
     * exists in the database.
     */
    public function testUpdateUser(): void
    {
        $updateUserData = [
            'email' => 'test2@example.com',
            'firstname' => 'Testing',
            'lastname' => 'Account'
        ];

        $user = User::factory()->create();
        $action = new UpdateUser();
        $user = $action->execute($user, $updateUserData);

        // Assert the user exists in the database
        $this->assertDatabaseHas('users', [
            'email' => $updateUserData['email'],
            'firstname' => $updateUserData['firstname'],
            'lastname' => $updateUserData['lastname'],
        ]);
    }
}
