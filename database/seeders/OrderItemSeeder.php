<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $normalTicket = TicketType::query()->where('name', 'Tiket Normal')->first();
        $terusanTicket = TicketType::query()->where('name', 'Tiket Terusan')->first();
        $onlineOrder = Order::query()->where('order_code', 'TKT-00000001')->first();
        $offlineOrder = Order::query()->where('order_code', 'TKT-00000002')->first();

        if ($onlineOrder && $terusanTicket) {
            OrderItem::query()->create([
                'order_id' => $onlineOrder->id,
                'ticket_type_id' => $terusanTicket->id,
                'qty' => 1,
                'price' => $terusanTicket->price,
                'subtotal' => $terusanTicket->price,
            ]);
        }

        if ($offlineOrder && $normalTicket) {
            OrderItem::query()->create([
                'order_id' => $offlineOrder->id,
                'ticket_type_id' => $normalTicket->id,
                'qty' => 1,
                'price' => $normalTicket->price,
                'subtotal' => $normalTicket->price,
            ]);
        }
    }
}
