<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement(['Spa Air Hangat', 'Fotografi Wisata', 'Sewa Wahana']);

        return [
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 999)), // Sesuaikan jika slug mau diatur manual.
            'name' => $name,
            'description' => fake()->paragraph(),
            'price' => fake()->randomElement([ 50000, 75000, 100000]),
            'duration' => fake()->randomElement(['30 menit', '60 menit', '120 menit']), // Sesuaikan format durasi jika perlu.
            'thumbnail' => 'seeders/sendang.png', // Sesuaikan dengan path asset yang tersedia.
        ];
    }
}
