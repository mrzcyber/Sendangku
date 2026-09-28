<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\RestaurantOrder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use function Illuminate\Support\now;

#[Signature('app:expire-orders')]
#[Description('Command description')]
class ExpireOrders extends Command
{
      protected $signature = 'orders:expire';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::where('pay_status','pending')
        ->where('created_at','<=',now()->subHours(25))
        ->update(['pay_status' => 'failed']);

        RestaurantOrder::where('pay_status','pending')
        ->where('created_at','<=',now()->subHours(25))
        ->update(['pay_status' => 'failed']);

        $this->info('pay_status telah di update menjadi expired');
    }
}
