<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->updateOrCreate(
            ['slug' => 'spa-air-hangat'], // Sesuaikan slug jika nanti punya aturan khusus.
            [
                'name' => 'Spa Air Hangat',
                'description' => 'Layanan relaksasi air hangat untuk pengunjung Sendangku.',
                'price' => 50000,
                'duration' => '60 menit', // Sesuaikan durasi aktual.
                'thumbnail' => 'seeders/sendang.png', // Sesuaikan path asset.
            ]
        );

        Service::query()->updateOrCreate(
            ['slug' => 'fotografi-wisata'], // Sesuaikan slug jika nanti punya aturan khusus.
            [
                'name' => 'Fotografi Wisata',
                'description' => 'Layanan dokumentasi kunjungan wisata.',
                'price' => 75000,
                'duration' => '60 menit', // Sesuaikan durasi aktual.
                'thumbnail' => 'seeders/sendang.png', // Sesuaikan path asset.
            ]
        );
    }
}
