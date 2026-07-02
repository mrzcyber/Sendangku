<?php

namespace Database\Factories;

use App\Models\RestaurantMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RestaurantMenu>
 */
class RestaurantMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => true,
            'name' => fake()->randomElement(['Nasi Goreng', 'Mie Goreng', 'Es Teh', 'Kopi Tubruk']),
            'thumbnail' => 'seeders/sendang.png', // Sesuaikan dengan path asset yang tersedia.
            'price' => fake()->randomElement([5000, 10000, 15000, 20000]),
        ];
    }
}
