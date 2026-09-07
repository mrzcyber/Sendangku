<?php

namespace App\Services;

use App\Models\Order;
use App\Models\TicketType;
use App\Services\MidtransService;
use Illuminate\Support\Facades\DB;

class UserOrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct( protected MidtransService $midtrans) {}
    public function createOrder(array $data)
    {
        Order::where('buyer_email', $data['buyer_email'])
            ->where('pay_status', 'pending')
            ->delete();
        
        $totalPrice = 0 ;
        $orderItems = [];
        foreach ($data['items'] as $item) {
            if($item['qty'] == 0)continue;
            $ticket = TicketType::findOrFail($item['ticket_type_id']);
            $totalPrice += $item['qty'] * $ticket->price;

            $orderItems[] = [
                'ticket_type_id' => $ticket->id,
                'qty' => $item['qty'],
                'price' => $ticket->price,
                'subtotal' => $item['qty'] * $ticket->price
            ];
        }

        $order = DB::transaction(function() use ($data,$totalPrice,$orderItems){
           $order = Order::create([
                'purchase'=>$data['purchase'],
                'buyer_name'=>$data['buyer_name'],
                'buyer_phone'=>$data['buyer_phone'],
                'buyer_email'=>$data['buyer_email'],
                'total_price'=>$totalPrice
            ]);
            $orderCode = 'TSG-'.date('dmy').str_pad($order->id,8,'0',STR_PAD_LEFT);

            $order->update([
                'order_code'=>$orderCode
            ]);

            $order->orderItems()->createMany($orderItems);
            return $order;

        });

        return $order; 
    }

    public function generateSnapToken(Order $order): string
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'name' => $order->buyer_name,
                'email' => $order->buyer_email,
                'phone' => $order->buyer_phone,
            ],
            'item_details' => $order->orderItems->map(function ($item) {
                return [
                    'id' => $item->ticket_type_id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'name' => $item->ticketType->name,
                ];
            })->toArray(),
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
