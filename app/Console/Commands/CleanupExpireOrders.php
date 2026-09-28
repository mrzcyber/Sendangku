<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\RestaurantOrder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use function Illuminate\Support\now;

#[Signature('app:cleanup-expire-orders')]
#[Description('Command description')]
class CleanupExpireOrders extends Command
{
      protected $signature = 'orders:cleanup';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::where('pay_status','failed')
        ->where('updated_at','<=',now()->subMonth())
        ->delete();

        RestaurantOrder::where('pay_status','failed')
        ->where('updated_at','<=',now()->subMonth())
        ->delete();
    }
}
