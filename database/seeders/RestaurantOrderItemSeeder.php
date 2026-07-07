<?php

namespace Database\Seeders;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderItem;
use Illuminate\Database\Seeder;

class RestaurantOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = RestaurantOrder::query()->where('order_code', 'RST-00000001')->first();
        $menu = RestaurantMenu::query()->where('name', 'Nasi Goreng')->first();

        if (! $order || ! $menu) {
            return;
        }

        RestaurantOrderItem::query()->create([
            'restaurant_order_id' => $order->id,
            'restaurant_menu_id' => $menu->id,
            'qty' => 1,
            'price' => $menu->price,
            'subtotal' => $menu->price,
        ]);
    }
}
