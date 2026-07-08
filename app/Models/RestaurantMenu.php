<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'thumbnail',
        'price',
    ];

    public function restaurantOrderItems():HasMany
    {
        return $this->hasMany(RestaurantOrderItem::class);
    }
}
