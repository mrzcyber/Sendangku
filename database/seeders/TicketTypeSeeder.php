<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::query()->updateOrCreate(
            ['name' => 'Tiket Normal'],
            ['price' => 10000]
        );

        TicketType::query()->updateOrCreate(
            ['name' => 'Tiket Terusan'],
            ['price' => 25000] // Sesuaikan harga tiket aktual.
        );
    }
}
