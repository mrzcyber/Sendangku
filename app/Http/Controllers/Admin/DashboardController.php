<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantOrder;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $range = $request->query('range', 'all');

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

        // 1. Pendapatan Tiket (Order)
        $ticketOrders = $this->successfulOrders();
        $applyDateFilter($ticketOrders, 'orders.created_at');
        $ticketRevenue = (clone $ticketOrders)->sum('total_price');

        // 2. Pendapatan Restoran (RestaurantOrder)
        $restaurantOrders = RestaurantOrder::query()->where('status', 'success');
        $applyDateFilter($restaurantOrders, 'created_at');
        $restaurantRevenue = (clone $restaurantOrders)->sum('total_price');

        // 3. Total Pendapatan Gabungan
        $totalRevenue = $ticketRevenue + $restaurantRevenue;

        // 4. Total Pengunjung (Qty seluruh tiket terjual)
        $totalVisitors = $this->ticketItemsFor($ticketOrders)->sum('qty');

        // 5. Persentase Pembelian Tiket Online vs Offline
        $onlineTickets = $this->ticketItemsFor((clone $ticketOrders)->where('purchase', 'online'))->sum('qty');
        $offlineTickets = $this->ticketItemsFor((clone $ticketOrders)->where('purchase', 'offline'))->sum('qty');

        $totalTickets = $onlineTickets + $offlineTickets;
        $onlinePercentage = $totalTickets > 0 ? (int) round(($onlineTickets / $totalTickets) * 100) : 0;
        $offlinePercentage = $totalTickets > 0 ? 100 - $onlinePercentage : 0;

        // 6. Data Pengunjung Minggu Ini (Senin s/d Minggu) untuk Traffic Chart
        $startOfWeek = CarbonImmutable::now()->startOfWeek();
        $endOfWeek = CarbonImmutable::now()->endOfWeek();

        $trafficByDate = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where(function (Builder $query) {
                $this->applySuccessfulOrderScope($query, 'orders.');
            })
            ->where(function ($q) use ($startOfWeek, $endOfWeek) {
                $q->whereBetween('orders.scanned_at', [$startOfWeek->startOfDay(), $endOfWeek->endOfDay()])
                  ->orWhere(function ($sub) use ($startOfWeek, $endOfWeek) {
                      $sub->whereNull('orders.scanned_at')
                          ->whereBetween('orders.created_at', [$startOfWeek->startOfDay(), $endOfWeek->endOfDay()]);
                  });
            })
            ->selectRaw('DATE(COALESCE(orders.scanned_at, orders.created_at)) as date, SUM(order_items.qty) as visitors')
            ->groupBy('date')
            ->pluck('visitors', 'date');

        $trafficLabels = [];
        $trafficValues = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->addDays($i);
            $trafficLabels[] = $date->translatedFormat('D'); // Sen, Sel, Rab, Kam, Jum, Sab, Min
            $trafficValues[] = (int) ($trafficByDate->get($date->toDateString()) ?? 0);
        }

        $rangeLabels = [
            'today' => 'Hari Ini',
            'week' => 'Minggu Ini',
            'month' => 'Bulan Ini',
            'all' => 'Semua Waktu',
        ];
        $dateRangeLabel = $rangeLabels[$range] ?? 'Semua Waktu';

        return view('admin.index', compact(
            'totalRevenue',
            'ticketRevenue',
            'restaurantRevenue',
            'totalVisitors',
            'onlineTickets',
            'offlineTickets',
            'onlinePercentage',
            'offlinePercentage',
            'trafficLabels',
            'trafficValues',
            'range',
            'dateRangeLabel',
        ));
    }

    private function successfulOrders(): Builder
    {
        return Order::query()->where(function (Builder $query) {
            $this->applySuccessfulOrderScope($query);
        });
    }

    private function ticketItemsFor(Builder $orders): Builder
    {
        return OrderItem::query()->whereIn('order_id', (clone $orders)->select('id'));
    }

    private function applySuccessfulOrderScope(Builder $query, string $tablePrefix = ''): void
    {
        $query->where(function (Builder $query) use ($tablePrefix) {
            $query->where(function (Builder $query) use ($tablePrefix) {
                $query->where("{$tablePrefix}purchase", 'online')
                    ->where("{$tablePrefix}pay_status", 'paid');
            })->orWhere(function (Builder $query) use ($tablePrefix) {
                $query->where("{$tablePrefix}purchase", 'offline')
                    ->where("{$tablePrefix}status", 'used');
            });
        });
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
