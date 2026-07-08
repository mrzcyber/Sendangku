<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function service():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
