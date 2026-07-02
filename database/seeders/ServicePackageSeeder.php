<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Database\Seeder;

class ServicePackageSeeder extends Seeder
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

        ServicePackage::query()->create([
            'service_id' => $service->id,
            'title' => 'Paket Relaksasi',
            'price' => 50000,
            'benefit' => 'Akses spa air hangat, handuk, dan minuman.', // Sesuaikan detail benefit.
            'whatsapp_message' => 'Halo, saya ingin booking Paket Relaksasi Sendangku.', // Sesuaikan pesan WA.
            'whatsapp_number' => '6281234567890', // Sesuaikan nomor WA tujuan.
            'populer' => true,
        ]);
    }
}
