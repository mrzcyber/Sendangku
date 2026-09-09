<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantOrder\StoreRestaurantOrderRequest;
use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestaurantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RestaurantMenu::query()
            ->where('status', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get();
        $tables = Table::orderBy('number', 'asc')->get();
        return view('front.restourant', compact('data', 'tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantOrderRequest $request)
    {
        $validated = $request->validated();

        $menuIds = collect($validated['items'])->pluck('restaurant_menu_id')->unique();
        $menus = RestaurantMenu::query()
            ->where('status', true)
            ->whereIn('id', $menuIds)
            ->get()
            ->keyBy('id');

        if ($menus->count() !== $menuIds->count()) {
            return back()
                ->withInput()
                ->withErrors(['items' => 'Satu atau lebih menu sudah tidak tersedia.']);
        }

        $items = collect($validated['items'])->map(function (array $item) use ($menus) {
            $menu = $menus->get($item['restaurant_menu_id']);
            $quantity = $item['qty'];

            return [
                'restaurant_menu_id' => $menu->id,
                'qty' => $quantity,
                'price' => $menu->price,
                'subtotal' => $menu->price * $quantity,
            ];
        });

        $order = DB::transaction(function () use ($validated, $items) {
            $order = RestaurantOrder::create([
                'order_code' => 'R' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                'name' => $validated['name'],
                'table_id' => $validated['table_id'],
                'note' => $validated['note'] ?? null,
                'total_price' => $items->sum('subtotal'),
                'status' => 'pending',
                'payment' => 'offline',
            ]);

            $order->restaurantOrderItems()->createMany($items->all());

            return $order;
        });

        return redirect()
            ->route('restaurant.order')
            ->with('success', "Pesanan {$order->order_code} berhasil dibuat.");
    }
}
