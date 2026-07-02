<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scanner = User::query()->where('role', 'tiket')->first();

        Order::factory()->create([
            'order_code' => 'TKT-00000001',
            'buyer_name' => 'Pengunjung Online',
            'buyer_phone' => '081234567890', // Sesuaikan format nomor HP pembeli.
            'buyer_email' => 'pengunjung@example.com',
            'total_price' => 25000, // Sesuaikan dengan total item tiket.
            'status' => 'active',
            'purchase' => 'online',
            'scanned_at' => null,
            'scanned_by' => null,
        ]);

        Order::factory()->create([
            'order_code' => 'TKT-00000002',
            'buyer_name' => 'Pengunjung Offline',
            'buyer_phone' => '089876543210', // Sesuaikan format nomor HP pembeli.
            'buyer_email' => 'offline@example.com',
            'total_price' => 10000, // Sesuaikan dengan total item tiket.
            'status' => 'used',
            'purchase' => 'offline',
            'scanned_at' => now(),
            'scanned_by' => $scanner?->id, // Null jika belum ada user role tiket.
        ]);
    }
}
