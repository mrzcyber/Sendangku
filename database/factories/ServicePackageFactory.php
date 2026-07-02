<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServicePackage>
 */
class ServicePackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'title' => fake()->randomElement(['Paket Basic', 'Paket Family', 'Paket Premium']),
            'price' => fake()->randomElement([100000, 150000, 250000]),
            'benefit' => fake()->sentences(3, true), // Sesuaikan format benefit jika nanti perlu list terstruktur.
            'whatsapp_message' => 'Halo, saya ingin booking layanan Sendangku.', // Sesuaikan copywriting WA.
            'whatsapp_number' => '6281234567890', // Sesuaikan nomor WhatsApp tujuan.
            'populer' => fake()->boolean(30),
        ];
    }
}
