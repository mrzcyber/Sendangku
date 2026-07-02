<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceGallery;
use Illuminate\Database\Seeder;

class ServiceGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = Service::query()->where('slug', 'spa-air-hangat')->first();

        if (! $service) {
            return;
        }

        ServiceGallery::query()->create([
            'service_id' => $service->id,
            'image' => 'seeders/sendang.png', // Sesuaikan path asset.
        ]);
    }
}
