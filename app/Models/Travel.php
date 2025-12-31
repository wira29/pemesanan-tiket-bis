<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'date',
        'vehicle_number',
        'from',
        'destination',
        'is_half',
        'remarks',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    protected $casts = [
        'date' => 'date',
    ];
}
