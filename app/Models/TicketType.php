<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'benefit',
    ];

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
