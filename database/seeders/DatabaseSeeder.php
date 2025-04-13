<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,  // Set is_admin to true
        ]);

        // Call the other seeders
        $this->call([
            CategorySeeder::class,
            CardSeeder::class,
        ]);

        $this->call([
            DesignSettingsSeeder::class,
        ]);
    }
}

