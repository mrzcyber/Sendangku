<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['active', 'used']);

        return [
            'order_code' => fake()->unique()->bothify('TKT-########'),
            'qr_token' => (string) Str::uuid(),
            'buyer_name' => fake()->name(),
            'buyer_phone' => fake()->phoneNumber(), // Sesuaikan format nomor HP jika ada standar khusus.
            'buyer_email' => fake()->safeEmail(),
            'total_price' => fake()->numberBetween(10000, 150000),
            'status' => $status,
            'pay_status' => fake()->randomElement(['pending', 'paid']),
            'snap_token' => $status === 'active' ? null : fake()->uuid(),
            'purchase' => fake()->randomElement(['online', 'offline']),
            'scanned_at' => $status === 'used' ? fake()->dateTimeBetween('-1 month') : null,
            'scanned_by' => null, // Isi id petugas tiket jika order sudah discan.
        ];
    }
}
