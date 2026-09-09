<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantOrder\StoreRestaurantOrderRequest;
use App\Models\RestaurantMenu;
use App\Models\Table;
use App\Services\RestourantService;
use Illuminate\Support\Facades\RateLimiter;

class RestaurantOrderController extends Controller
{
    public function __construct(private RestourantService $restourantService) {}

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
        $key = 'restaurant-pay:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 2)) {
            return response()->json([
                'message' => 'Terlalu banyak percobaan, silakan coba lagi nanti.',
            ], 429);
        }

        RateLimiter::hit($key, 60);

        $order = $this->restourantService->createOrder($request->validated());
        $snapToken = $this->restourantService->generateSnapToken($order);

        return response()->json([
            'snap_token' => $snapToken,
            'order_code' => $order->order_code,
        ]);
    }
}
