<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //  Admin user.
        User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password1234'),
            'type' => 'admin',
        ]);

        //  Regular user.
        User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'username' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('Password1234'),
            'type' => 'user',
        ]);
    }
}
