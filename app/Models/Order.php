<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'qr_token',
        'buyer_name',
        'buyer_phone',
        'buyer_email',
        'total_price',
        'status',
        'purchase',
        'scanned_at',
        'scanned_by',
    ];
}
