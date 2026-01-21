<?php

namespace Tests\Feature;

use App\Events\UserSaved;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SyncUserProfileDetailsTest extends TestCase {
    use RefreshDatabase;

    /**
     * Check all four expected `details` records are created.
     */
    public function testSyncUserProfileDetails(): void {
        $user = User::factory()->create([
            'prefixname' => 'Mr',
            'firstname' => 'Test',
            'middlename' => 'User',
            'lastname' => 'A',
            'photo' => 'https://example.com/avatar.jpg',
        ]);

        //  Check four detail records exist.
        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'type' => 'profile',
            'key' => 'Full name',
            'value' => 'Test User A',
        ]);

        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'type' => 'profile',
            'key' => 'Middle Initial',
            'value' => 'U',
        ]);

        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'type' => 'profile',
            'key' => 'Avatar',
            'value' => 'https://example.com/avatar.jpg',
        ]);

        $this->assertDatabaseHas('details', [
            'user_id' => $user->id,
            'type' => 'profile',
            'key' => 'Gender',
            'value' => 'Male',
        ]);
    }
}
