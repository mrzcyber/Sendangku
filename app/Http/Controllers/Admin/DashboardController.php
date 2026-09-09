<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $successfulOrders = $this->successfulOrders();

        $totalRevenue = (clone $successfulOrders)->sum('total_price');
        $totalVisitors = $this->ticketItemsFor($successfulOrders)->sum('qty');
        $onlineTickets = $this->ticketItemsFor((clone $successfulOrders)->where('purchase', 'online'))->sum('qty');
        $offlineTickets = $this->ticketItemsFor((clone $successfulOrders)->where('purchase', 'offline'))->sum('qty');

        $trafficStart = CarbonImmutable::today()->subDays(6);
        $trafficByDate = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotNull('orders.scanned_at')
            ->whereBetween('orders.scanned_at', [$trafficStart, CarbonImmutable::tomorrow()])
            ->where(function (Builder $query) {
                $this->applySuccessfulOrderScope($query, 'orders.');
            })
            ->selectRaw('DATE(orders.scanned_at) as date, SUM(order_items.qty) as visitors')
            ->groupBy('date')
            ->pluck('visitors', 'date');

        $trafficLabels = [];
        $trafficValues = [];

        foreach (range(0, 6) as $offset) {
            $date = $trafficStart->addDays($offset);
            $trafficLabels[] = $date->translatedFormat('D');
            $trafficValues[] = (int) ($trafficByDate->get($date->toDateString()) ?? 0);
        }

        $totalTickets = $onlineTickets + $offlineTickets;
        $onlinePercentage = $totalTickets > 0 ? (int) round(($onlineTickets / $totalTickets) * 100) : 0;
        $offlinePercentage = $totalTickets > 0 ? 100 - $onlinePercentage : 0;

        return view('admin.index', compact(
            'totalRevenue',
            'totalVisitors',
            'onlineTickets',
            'offlineTickets',
            'onlinePercentage',
            'offlinePercentage',
            'trafficLabels',
            'trafficValues',
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
