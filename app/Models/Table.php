<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'table_code',
    ];

    public function restaurantOrders():HasMany
    {
        return $this->hasMany(RestaurantOrder::class);
    }
}
