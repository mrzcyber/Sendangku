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
    public function index()
    {
        return view('admin.ticket.dashboard');
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
