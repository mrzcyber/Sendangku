<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'name',
        'tables_id',
        'note',
        'total_price',
        'status',
        'payment',
    ];
}
