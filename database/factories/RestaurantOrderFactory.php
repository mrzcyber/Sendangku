<?php

namespace Database\Factories;

use App\Models\RestaurantOrder;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RestaurantOrder>
 */
class RestaurantOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_code' => fake()->unique()->bothify('RST-########'),
            'tables_id' => Table::factory(),
            'total_price' => fake()->numberBetween(10000, 200000),
            'status' => fake()->randomElement(['pending', 'success', 'failed']),
            'payment' => fake()->randomElement(['offline', 'online']),
        ];
    }
}
