<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Unique identifier to prevent duplicates
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Choose a secure password
                'is_role' => User::ROLE_ADMIN,
                'email_verified_at' => now(), // Optional: mark email as verified
            ]
        );

        User::firstOrCreate(
            ['email' => 'pharmacien@example.com'],
            [
                'name' => 'Pharmacien User',
                'password' => Hash::make('password'),
                'is_role' => User::ROLE_PHARMACIEN,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'is_role' => User::ROLE_UTILISATEUR,
                'email_verified_at' => now(),
            ]
        );
    }
}
