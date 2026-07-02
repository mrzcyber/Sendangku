<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'price',
        'benefit',
        'whatsapp_message',
        'whatsapp_number',
        'populer',
    ];
}
