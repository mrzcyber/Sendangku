<?php

namespace Database\Seeders;

use App\Models\RestaurantOrder;
use App\Models\Table;
use Illuminate\Database\Seeder;

class RestaurantOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = Table::query()->where('number', 1)->first();

        if (! $table) {
            return;
        }

        RestaurantOrder::query()->create([
            'order_code' => 'RST-00000001',
            'name' => 'Budi Santoso',
            'table_id' => $table->id,
            'note' => 'Tidak pedas.',
            'total_price' => 20000, // Sesuaikan dengan total item restoran.
            'status' => 'pending',
            'payment' => 'online',
        ]);
    }
}
