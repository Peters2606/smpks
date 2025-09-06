<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Admin User',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Create Legal User
        User::firstOrCreate(['email' => 'legal@example.com'], [
            'name' => 'Legal User',
            'role' => 'legal',
            'password' => Hash::make('password'),
        ]);

        // Create Marketing User
        User::firstOrCreate(['email' => 'marketing@example.com'], [
            'name' => 'Marketing User',
            'role' => 'marketing',
            'password' => Hash::make('password'),
        ]);
    }
}