<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderItem;
use Illuminate\Http\Request;

class RestaurantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $range = $request->query('range', 'all');
        $confirmationFilter = $request->query('confirmed', '0');
        $confirmationFilter = in_array($confirmationFilter, ['all', '0', '1'], true) ? $confirmationFilter : 'all';

        $applyDateFilter = function ($query, string $column = 'created_at') use ($range) {
            if ($range === 'today') {
                $query->whereDate($column, today());
            } elseif ($range === 'week') {
                $query->whereBetween($column, [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($range === 'month') {
                $query->whereMonth($column, now()->month)
                    ->whereYear($column, now()->year);
            }
        };

        // 1. Total Pendapatan: hanya pesanan dengan status 'success' (pending tidak dihitung revenue)
        $revenueQuery = RestaurantOrder::query()
            ->where('pay_status', 'success');
        $applyDateFilter($revenueQuery);
        $totalRevenue = $revenueQuery->sum('total_price');

        // 2. Total Pembelian (hanya transaksi yang pembayarannya sukses)
        $ordersCountQuery = RestaurantOrder::query()->where('pay_status', 'success');
        $applyDateFilter($ordersCountQuery);
        $totalOrders = $ordersCountQuery->count();

        // 3. Rekap jumlah item terjual per kategori (hanya dari pesanan success)
        $itemsQuery = RestaurantOrderItem::query()
            ->join('restaurant_orders', 'restaurant_orders.id', '=', 'restaurant_order_items.restaurant_order_id')
            ->join('restaurant_menus', 'restaurant_menus.id', '=', 'restaurant_order_items.restaurant_menu_id')
            ->where('restaurant_orders.pay_status', 'success');
        $applyDateFilter($itemsQuery, 'restaurant_orders.created_at');

        $foodCount = (clone $itemsQuery)->where('restaurant_menus.category', 'makanan')->sum('restaurant_order_items.qty');
        $drinkCount = (clone $itemsQuery)->where('restaurant_menus.category', 'minuman')->sum('restaurant_order_items.qty');
        $otherCount = (clone $itemsQuery)->where('restaurant_menus.category', 'lainnya')->sum('restaurant_order_items.qty');
        $packageCount = (clone $itemsQuery)->where(function ($q) {
            $q->where('restaurant_menus.category', 'paket')
                ->orWhere('restaurant_menus.name', 'like', '%paket%');
        })->sum('restaurant_order_items.qty');

        // 4. Query transaksi untuk tabel (dengan pagination)
        $listQuery = RestaurantOrder::query()
            ->where('pay_status', 'success')
            ->with(['table', 'restaurantOrderItems.restaurantMenu']);
        $applyDateFilter($listQuery);
        if ($confirmationFilter !== 'all') {
            $listQuery->where('confirmed', $confirmationFilter === '1');
        }

        $orders = $listQuery->latest()->paginate(10)->withQueryString();

        // 5. Pesanan yang belum dikonfirmasi dan pembayarannya sukses
        $unconfirmedOrders = RestaurantOrder::query()
            ->with(['table', 'restaurantOrderItems.restaurantMenu'])
            ->where('confirmed', false)
            ->where('pay_status', 'success')
            ->latest()
            ->get();

        $unconfirmedCount = $unconfirmedOrders->count();

        $rangeLabels = [
            'today' => 'Hari Ini',
            'week' => 'Minggu Ini',
            'month' => 'Bulan Ini',
            'all' => 'Semua Waktu',
        ];
        $dateRangeLabel = $rangeLabels[$range] ?? 'Semua Waktu';

        return view('admin.restaurant.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'foodCount',
            'drinkCount',
            'otherCount',
            'packageCount',
            'orders',
            'range',
            'confirmationFilter',
            'dateRangeLabel',
            'unconfirmedOrders',
            'unconfirmedCount'
        ));
    }

    /**
     * Konfirmasi pesanan sudah dibuat/disiapkan.
     */
    public function confirm($id)
    {
        $order = RestaurantOrder::findOrFail($id);
        $order->confirmed = true;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dikonfirmasi.']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
