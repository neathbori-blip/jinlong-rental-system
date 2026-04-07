<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // ← ADD THIS LINE
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email' => 'landlord1@example.com',
            'password' => Hash::make('password123'),
            'first_name' => 'Sok',
            'last_name' => 'Heng',
            'phone' => '012345678',
            'role' => 'landlord'
        ]);

        User::create([
            'email' => 'landlord2@example.com',
            'password' => Hash::make('password123'),
            'first_name' => 'Maly',
            'last_name' => 'Sok',
            'phone' => '098765432',
            'role' => 'landlord'
        ]);

        User::create([
            'email' => 'tenant1@example.com',
            'password' => Hash::make('password123'),
            'first_name' => 'Phara',
            'last_name' => 'Chan',
            'phone' => '011223344',
            'role' => 'tenant'
        ]);

        User::create([
            'email' => 'tenant2@example.com',
            'password' => Hash::make('password123'),
            'first_name' => 'Sokha',
            'last_name' => 'Mean',
            'phone' => '077889900',
            'role' => 'tenant'
        ]);

        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'first_name' => 'Admin',
            'last_name' => 'System',
            'phone' => '010101010',
            'role' => 'admin'
        ]);
    }
}