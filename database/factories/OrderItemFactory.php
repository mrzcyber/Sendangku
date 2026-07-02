<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = fake()->numberBetween(1, 5);
        $price = fake()->randomElement([10000, 15000, 25000]);

        return [
            'order_id' => Order::factory(),
            'ticket_type_id' => TicketType::factory(),
            'qty' => $qty,
            'price' => $price,
            'subtotal' => $qty * $price,
        ];
    }
}
