<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceGallery>
 */
class ServiceGalleryFactory extends Factory
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
            'image' => 'seeders/sendang.png', // Sesuaikan dengan path asset yang tersedia.
        ];
    }
}
