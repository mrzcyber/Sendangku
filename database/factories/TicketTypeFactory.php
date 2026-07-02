<?php

namespace Database\Factories;

use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TicketType>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Tiket Normal', 'Tiket Terusan',]),
            'price' => fake()->randomElement([10000, 25000]),
            'benefit' => fake()->randomElement(['kolam pemandian', 'kolam pemandian,waterboom, dan terapi ikan']),
        ];
    }
}
