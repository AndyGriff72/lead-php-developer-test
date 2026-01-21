<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    protected $newUserData = [
        'prefixname' => 'Mr',
        'firstname' => 'Test',
        'middlename' => 'A',
        'lastname' => 'User',
        'username' => 'test',
        'email' => 'test@example.com',
        'password' => 'Password1234',
        'photo' => 'photo.jpg',
        'type' => 'user',
    ];

    /**
     * Test that CreateUser creates a user and that the user subsequently
     * exists in the database.
     */
    public function testCreateUser(): void
    {
        $action = new CreateUser();
        $user = $action->execute($this->newUserData);

        // Assert the returned instance is a User
        $this->assertInstanceOf(User::class, $user);

        // Assert the user exists in the database
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'firstname' => 'Test',
            'lastname' => 'User',
        ]);
    }

    /**
     * Test that creating two users with the same data (i.e. duplicate username and/or
     * email addresses) causes a query exception to be thrown.
     */
    public function testCreateDuplicateUser(): void
    {
        $action = new CreateUser();
        $action->execute($this->newUserData);

        $this->expectException(\Illuminate\Database\QueryException::class);
        $action->execute($this->newUserData);
    }
}
