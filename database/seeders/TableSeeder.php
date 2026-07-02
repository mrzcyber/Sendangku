<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $number) { // Sesuaikan jumlah meja aktual.
            Table::query()->updateOrCreate(
                ['number' => $number],
                ['table_code' => 'MEJA-' . str_pad((string) $number, 3, '0', STR_PAD_LEFT)]
            );
        }
    }
}
