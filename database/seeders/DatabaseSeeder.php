<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Message::factory(20)->create();
/*
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test.user@example.com',
        ]);
*/
    }
}