<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = fake()->unique()->numberBetween(1, 100);

        return [
            'number' => $number,
            'table_code' => 'MEJA-' . str_pad((string) $number, 3, '0', STR_PAD_LEFT),
        ];
    }
}
