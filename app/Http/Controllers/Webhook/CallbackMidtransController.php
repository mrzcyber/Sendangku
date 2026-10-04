<?php

namespace App\Http\Controllers\Webhook;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\RestaurantOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CallbackMidtransController
{
    public function callback(Request $request)
    {
        $n = $request->all();

        // Verifikasi signature
        $expected = hash('sha512',
            ($n['order_id'] ?? '') . ($n['status_code'] ?? '') .
            ($n['gross_amount'] ?? '') . config('services.midtrans.server_key'));

        if (! hash_equals($expected, (string) ($n['signature_key'] ?? ''))) {
            return response()->json(['message' => 'invalid signature'], 403);
        }

        $code   = $n['order_id'];
        $status = $n['transaction_status'] ?? '';

        $isPaid   = $status === 'settlement';
        $isFailed = in_array($status, ['expire', 'cancel', 'deny', 'failure']);

        // --- Pesanan restoran ---
        if ($restaurantOrder = RestaurantOrder::where('order_code', $code)->first()) {
            if ($isPaid) {
                RestaurantOrder::whereKey($restaurantOrder->id)
                    ->where('pay_status', '!=', 'success')
                    ->update(['pay_status' => 'success']);

                Cache::forget('kasir:waiting-ids');
            } elseif ($isFailed) {
                RestaurantOrder::whereKey($restaurantOrder->id)
                    ->where('pay_status', 'pending') 
                    ->update(['pay_status' => 'failed']);
            }

            return response()->json(['message' => 'ok']);
        }

        // --- Tiket ---
        if ($order = Order::where('order_code', $code)->first()) {
            if ($isPaid) {
                $updated = Order::whereKey($order->id)
                    ->where('pay_status', '!=', 'paid')
                    ->update(['pay_status' => 'paid']);

                if ($updated) {  
                    $path = 'qrcodes/' . $order->qr_token . '.png';
                    Storage::disk('public')->put($path,
                        QrCode::format('png')->size(300)->generate($order->qr_token));
                    $order->update(['qr_path' => $path]);

                    Mail::to($order->buyer_email)->queue(new OrderConfirmationMail($order));
                }
            } elseif ($isFailed) {
                Order::whereKey($order->id)
                    ->where('pay_status', 'pending')
                    ->update(['pay_status' => 'failed']);
            }

            return response()->json(['message' => 'ok']);
        }

        return response()->json(['message' => 'Order not found'], 404);
    }
}