<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(4);

        return [
            'name' => $name,
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 999)), // Sesuaikan jika slug mau diatur manual.
            'thumbnail' => 'seeders/sendang.png', // Sesuaikan dengan path asset yang tersedia.
            'content' => fake()->paragraphs(5, true),
        ];
    }
}
