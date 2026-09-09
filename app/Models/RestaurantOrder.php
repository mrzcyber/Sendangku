<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'name',
        'table_id',
        'note',
        'total_price',
        'snap_token',
        'status',
        'confirmed',
        'payment',
    ];
    
    protected $casts = [
        'confirmed' => 'boolean',
    ];

    public function table():BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function restaurantOrderItems():HasMany
    {
        return $this->hasMany(RestaurantOrderItem::class);
    }
}
