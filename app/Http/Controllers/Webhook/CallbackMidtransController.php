<?php

namespace App\Http\Controllers\Webhook;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CallbackMidtransController
{


    /**
     * Store a newly created resource in storage.
     */
    public function callback(Request $request)
    {
        logger($request->all());
        $notif = $request->all();
        $orderId = $notif['order_id'];
        $status = $notif['transaction_status'];
        $order = Order::with('orderItems')->where('order_code', $orderId)->first();


        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        if ($status === 'settlement' || $status === 'capture') {
            $order->update([
                'pay_status'=> 'paid'
            ]);
            Mail::to($order->buyer_email)->queue(new OrderConfirmationMail($order));

        }elseif (in_array($status, ['expire','cancel','deny'])) {
            $order->delete();
        }
        
      

         return response()->json([
            'message' => 'ok',

         ]);

    }

}
