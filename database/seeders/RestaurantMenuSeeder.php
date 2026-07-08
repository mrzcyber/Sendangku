<?php

namespace Database\Seeders;

use App\Models\RestaurantMenu;
use Illuminate\Database\Seeder;

class RestaurantMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantMenu::query()->updateOrCreate(
            ['name' => 'Nasi Goreng'],
            [
                'status' => true,
                'category' => 'makanan',
                'thumbnail' => 'seeders/sendang.png', // Sesuaikan path asset.
                'price' => 15000,
            ]
        );

        RestaurantMenu::query()->updateOrCreate(
            ['name' => 'Es Teh'],
            [
                'status' => true,
                'category' => 'minuman',
                'thumbnail' => 'seeders/sendang.png', // Sesuaikan path asset.
                'price' => 5000,
            ]
        );
    }
}
