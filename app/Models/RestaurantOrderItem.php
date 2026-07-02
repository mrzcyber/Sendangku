<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrderItem extends Model
{
    use HasFactory;

    protected $table = 'restaurant_orders_items';

    protected $fillable = [
        'restaurant_orders_id',
        'restaurant_menus_id',
        'qty',
        'price',
        'subtotal',
    ];
}
