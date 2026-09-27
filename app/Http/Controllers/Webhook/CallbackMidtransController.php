<?php

namespace App\Http\Controllers\Webhook;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\RestaurantOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $restaurantOrder = RestaurantOrder::where('order_code', $orderId)->first();


        if (!$order && !$restaurantOrder) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        if ($status === 'settlement' || $status === 'capture') {
            if ($order) {
                $order->update([
                    'pay_status' => 'paid',
                ]);
                $qrCode = QrCode::format('png')->size(300)->generate($order->qr_token);
                $path = 'qrcodes/' . $order->qr_token . '.png' ;
                Storage::disk('public')->put($path,$qrCode);
                $order->update(['qr_path'=>$path]);
                Mail::to($order->buyer_email)->queue(new OrderConfirmationMail($order));
            } else {
                $restaurantOrder->update(['pay_status' => 'success']);
            }

        }elseif (in_array($status, ['expire','cancel','deny'])) {
            if($order){
                $order->update([
                    'pay_status' => 'failed',
                ]);
            }
            else{
                $restaurantOrder->update(['pay_status' => 'failed']);
            }
        }
        
      

         return response()->json([
            'message' => 'status pesanan berhasil diperbarui',

         ]);

    }

}
