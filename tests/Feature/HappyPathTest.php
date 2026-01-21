<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HappyPathTest extends TestCase {
    use RefreshDatabase;

    public function testFullUserFlow(): void {
        $newUserData = [
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

        $updateUserData = [
            'email' => 'testing@example.com',
            'photo' => 'testphoto.png',
        ];

        //  Create admin user and use it.
        $admin = User::factory()->create(['type' => 'admin']);
        $this->actingAs($admin);

        //  Create another user.
        $createResponse = $this->postJson('/api/users', $newUserData);
        $createResponse->assertCreated();   //  HTTP 201 status
        $userId = $createResponse->json('data.id');

        //  Update second user.
        $updateResponse = $this->putJson('/api/users/' . $userId, $updateUserData);
        $updateResponse->assertOk();        //  HTTP 200 status

        //  Retrieve this user again (remembering model data is in the "data" element).
        $showResponse = $this->getJson('/api/users/' . $userId);
        $showResponse->assertOk();          //  HTTP 200 status
        $showResponse->assertJson(['data' => $updateUserData]);

        //  Delete the user.
        $deleteResponse = $this->deleteJson('/api/users/' . $userId);
        $deleteResponse->assertNoContent(); //  HTTP 204 status

        //  Check the user is definitely gone.
        $this->assertSoftDeleted('users', ['id' => $userId]);
    }
}
