<?php

namespace Database\Factories;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RestaurantOrderItem>
 */
class RestaurantOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = fake()->numberBetween(1, 5);
        $price = fake()->randomElement([5000, 10000, 15000, 20000]);

        return [
            'restaurant_orders_id' => RestaurantOrder::factory(),
            'restaurant_menus_id' => RestaurantMenu::factory(),
            'qty' => $qty,
            'price' => $price,
            'subtotal' => $qty * $price,
        ];
    }
}
