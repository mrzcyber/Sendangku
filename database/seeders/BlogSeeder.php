<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::query()->updateOrCreate(
            ['slug' => 'panduan-berkunjung-ke-sendangku' . fake()->unique()->numberBetween(1, 999)], // Sesuaikan slug jika nanti punya aturan khusus.
            [
                'name' => 'Panduan Berkunjung ke Sendangku',
                'thumbnail' => 'seeders/sendang.png', // Sesuaikan path asset.
                'content' => 'Konten awal panduan berkunjung ke Sendangku. Silakan sesuaikan isi artikel.',
            ]
        );
    }
}
