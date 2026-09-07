<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Services\UserOrderService;
use Illuminate\Support\Facades\RateLimiter;

class OrderController extends Controller
{
    public function __construct(private UserOrderService $userOrderService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketType::all()->map(function($t) {
        return [
            'id'      => $t->id,
            'name'    => $t->name,
            'price'   => $t->price,
            'benefit' => $t->benefit,
            'qty'     => 0,
        ];
    });

        return view('front.checkout-ticket', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreOrderRequest $request)
    {
        $key = 'pay'. $request->ip();
        
        if(RateLimiter::tooManyAttempts($key, 2)){
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'message'=>'terlalu banyak percobaan, silahkan coba lagi dalam '.$seconds.' detik'
            ],429);
        }

        RateLimiter::hit($key, 60);

        $order = $this->userOrderService->createOrder($request->validated());
        $snapToken = $this->userOrderService->generateSnapToken($order);

        return response()->json([
            'snap_token'=>$snapToken,
            ]);
    }

    public function success()
    {
        return view('front.ticket-success');
    }



}
