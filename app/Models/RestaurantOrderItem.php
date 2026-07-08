<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantOrderItem extends Model
{
    use HasFactory;

    protected $table = 'restaurant_order_items';

    protected $fillable = [
        'restaurant_order_id',
        'restaurant_menu_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function restaurantOrder():BelongsTo
    {
        return $this->belongsTo(RestaurantOrder::class);
    }

    public function restaurantMenu():BelongsTo
    {
        return $this->belongsTo(RestaurantMenu::class);
    }

}
