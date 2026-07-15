<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function($order){
        $order->qr_token = Str::uuid();
        });
    }

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

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }
}
