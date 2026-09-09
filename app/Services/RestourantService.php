<?php

namespace App\Services;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RestourantService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected MidtransService $midtrans) {}

    public function createOrder(array $data): RestaurantOrder
    {
        $menuIds = collect($data['items'])->pluck('restaurant_menu_id')->unique();
        $menus = RestaurantMenu::query()
            ->where('status', true)
            ->whereIn('id', $menuIds)
            ->get()
            ->keyBy('id');

        if ($menus->count() !== $menuIds->count()) {
            throw ValidationException::withMessages([
                'items' => 'Satu atau lebih menu sudah tidak tersedia.',
            ]);
        }

        $items = collect($data['items'])->map(function (array $item) use ($menus) {
            $menu = $menus->get($item['restaurant_menu_id']);
            $quantity = (int) $item['qty'];

            return [
                'restaurant_menu_id' => $menu->id,
                'qty' => $quantity,
                'price' => $menu->price,
                'subtotal' => $menu->price * $quantity,
            ];
        });

        return DB::transaction(function () use ($data, $items) {
            $order = RestaurantOrder::create([
                'order_code' => 'RST-' . now()->format('YmdHis') . strtoupper(str()->random(4)),
                'name' => $data['name'],
                'table_id' => $data['table_id'],
                'note' => $data['note'] ?? null,
                'total_price' => $items->sum('subtotal'),
                'status' => 'pending',
                'payment' => 'online',
            ]);

            $order->restaurantOrderItems()->createMany($items->all());

            return $order->load('restaurantOrderItems.restaurantMenu');
        });
    }

    public function generateSnapToken(RestaurantOrder $order): string
    {
        $order->loadMissing('restaurantOrderItems.restaurantMenu');

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->name,
            ],
            'item_details' => $order->restaurantOrderItems->map(function ($item) {
                return [
                    'id' => $item->restaurant_menu_id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'name' => $item->restaurantMenu?->name ?? 'Menu restoran',
                ];
            })->values()->toArray(),
            'expiry' => [
                'unit' => 'minute',
                'duration' => 15,
            ],
        ];

        $snapToken = $this->midtrans->CreateSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        return $snapToken;
    }

}
