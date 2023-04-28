<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $userOne = User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'is_admin' => true
         ]);

        $userTwo = User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);
        Listing::factory(20)->create([
            'user_id' => $userOne->id
            ]);
        Listing::factory(20)->create([
             'user_id' => $userTwo->id
            ]);
    }
}
