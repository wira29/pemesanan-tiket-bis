<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'travel_id',
        'seat_no',
        'name',
        'gender',
        'age',
        'is_half',
        'passport',
        'whatsapp',
        'from',
        'destination',
    ];

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }
}
