<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sendangku',
            'email' => 'admin@example.com',
            'email_verified_at' =>null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas Tiket',
            'email' => 'tiket@example.com',
            'email_verified_at' =>null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'tiket',
        ]);

        User::create([
            'name' => 'Kasir Restoran',
            'email' => 'kasir@example.com',
            'email_verified_at' =>null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'kasir',
        ]);

    }
}
