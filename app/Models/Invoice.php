<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{


    protected $fillable = [
        'invoice_code',
        'travel_id',
        'date',
        'total_price',
    ];

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    function tickets(): HasMany
    {
        return $this->hasMany(DetailInvoice::class);
    }

    protected $casts = [
        'date' => 'date',
    ];
}
