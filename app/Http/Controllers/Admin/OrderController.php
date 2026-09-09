<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $range = $request->query('range', 'all');
        $statusFilter = $request->query('status', 'all');
        $methodFilter = $request->query('method', 'all');

        $applyDateFilter = function ($query, string $column = 'orders.created_at') use ($range) {
            if ($range === 'today') {
                $query->whereDate($column, today());
            } elseif ($range === 'week') {
                $query->whereBetween($column, [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($range === 'month') {
                $query->whereMonth($column, now()->month)
                    ->whereYear($column, now()->year);
            }
        };

        // 1. Total Pendapatan: hanya pesanan tiket yang valid/terbayar
        $revenueQuery = Order::query()->where(function ($q) {
            $q->where('pay_status', 'paid')
              ->orWhere('purchase', 'offline');
        });
        $applyDateFilter($revenueQuery, 'created_at');
        $totalRevenue = $revenueQuery->sum('total_price');

        // 2. Tiket Terscan (status used)
        $scannedItemsQuery = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'used')
            ->where(function ($q) {
                $q->where('orders.pay_status', 'paid')
                  ->orWhere('orders.purchase', 'offline');
            });
        $applyDateFilter($scannedItemsQuery, 'orders.created_at');
        $scannedTicketsCount = (clone $scannedItemsQuery)->sum('order_items.qty');

        // 3. Tiket Belum Terscan (status active)
        $unscannedItemsQuery = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'active')
            ->where(function ($q) {
                $q->where('orders.pay_status', 'paid')
                  ->orWhere('orders.purchase', 'offline');
            });
        $applyDateFilter($unscannedItemsQuery, 'orders.created_at');
        $unscannedTicketsCount = (clone $unscannedItemsQuery)->sum('order_items.qty');

        // 4. Jumlah Pengunjung (total tiket valid terjual)
        $totalVisitors = $scannedTicketsCount + $unscannedTicketsCount;

        // 5. Total Terusan & Normal
        $ticketItemsQuery = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('ticket_types', 'ticket_types.id', '=', 'order_items.ticket_type_id')
            ->where(function ($q) {
                $q->where('orders.pay_status', 'paid')
                  ->orWhere('orders.purchase', 'offline');
            });
        $applyDateFilter($ticketItemsQuery, 'orders.created_at');

        $normalCount = (clone $ticketItemsQuery)
            ->where('ticket_types.name', 'like', '%normal%')
            ->sum('order_items.qty');

        $terusanCount = (clone $ticketItemsQuery)
            ->where('ticket_types.name', 'like', '%terusan%')
            ->sum('order_items.qty');

        // 6. Query transaksi untuk tabel
        $listQuery = Order::query()
            ->with(['orderItems.ticketType', 'user']);
        $applyDateFilter($listQuery, 'created_at');

        if ($statusFilter && $statusFilter !== 'all') {
            $listQuery->where('status', $statusFilter);
        }

        if ($methodFilter && $methodFilter !== 'all') {
            $listQuery->where('purchase', $methodFilter);
        }

        $orders = $listQuery->latest()->paginate(10)->withQueryString();

        $rangeLabels = [
            'today' => 'Hari Ini',
            'week' => 'Minggu Ini',
            'month' => 'Bulan Ini',
            'all' => 'Semua Waktu',
        ];
        $dateRangeLabel = $rangeLabels[$range] ?? 'Semua Waktu';

        return view('admin.ticket.dashboard', compact(
            'totalRevenue',
            'scannedTicketsCount',
            'unscannedTicketsCount',
            'totalVisitors',
            'normalCount',
            'terusanCount',
            'orders',
            'range',
            'statusFilter',
            'methodFilter',
            'dateRangeLabel'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = TicketType::get();
        return view('admin.ticket.checkout',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreOrderRequest $request)
    {
        
        $order = Order::create([
        'purchase'=>$request->input('purchase')
        ]);

        $orderCode = 'TSG-'.date('dmy').str_pad($order->id,8,'0',STR_PAD_LEFT);
        $totalPrice = 0 ;
        foreach ($request->items as $item) {
            if($item['qty'] == 0)continue;
            $ticket = TicketType::findOrFail($item['ticket_type_id']);
            $totalPrice += $item['qty'] * $ticket->price;

            OrderItem::create([
                'order_id'=>$order->id,
                'ticket_type_id'=>$ticket->id,
                'qty'=>$item['qty'],
                'price'=> $ticket->price,
                'subtotal'=> $item['qty'] * $ticket->price
            ]);
            }

            $order->update([
                'order_code'=>$orderCode,
                'total_price'=>$totalPrice,
                'scanned_at'=> now(),
                'scanned_by' => Auth::id(),
                'status'=>'used'
            ]);

            return redirect()->back()->with('success','tiket berhasil dibeli');
        
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

    public function scan()
    {
        return view('admin.ticket.scan');
    }

    public function verify(Request $request)
    {
       
$validator = Validator::make(
    $request->all(),
    [
        'qr_token' => ['required', 'uuid'],
    ],
    [
        'qr_token.required' => 'QR Code tidak ditemukan.',
        'qr_token.uuid' => 'QR Code tidak valid.',
    ]
);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => $validator->errors()->first('qr_token'),
    ], 422);
}




        $order = Order::with('orderItems.ticketType')
            ->where('qr_token', $request->qr_token)
            ->firstOrFail();
        
        $data = [];
        
        foreach ($order->orderItems as $item) {
            $data[] = [
                'ticket_type' => $item->ticketType->name,
                'qty' => $item->qty,
            ];
        }

         if (! $order) {
        return response()->json([
            'success' => false,
            'message' => 'QR tidak ditemukan.',
        ], 404);
            }
       
       if($order->status === 'used'){
            return response()->json([
                'success'=>false,
                'message'=>'Tiket Telah Digunakan pada '. $order->scanned_at,
                'data' => $data

            ]);
           }
        
           $order->update([
           'status'=>'used',
           'scanned_at'=>now(),
           'scanned_by'=>Auth::id()
           ]);
           return response()->json([
           'success' => true,
           'message' => 'Tiket berhasil diverifikasi.',
           'data' => $data
           ]);
           
    }
}
