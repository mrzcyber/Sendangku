<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Sendangku',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Petugas Tiket',
            'email' => 'tiket@example.com',
            'role' => 'tiket',
        ]);

        User::factory()->create([
            'name' => 'Kasir Restoran',
            'email' => 'kasir@example.com',
            'role' => 'kasir',
        ]);

        $this->call([
            TicketTypeSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ServiceSeeder::class,
            ServiceGallerySeeder::class,
            ServicePackageSeeder::class,
            BlogSeeder::class,
            RestaurantMenuSeeder::class,
            TableSeeder::class,
            RestaurantOrderSeeder::class,
            RestaurantOrderItemSeeder::class,
        ]);
    }
}
