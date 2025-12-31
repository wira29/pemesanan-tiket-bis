<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Str;
use Symfony\Polyfill\Uuid\Uuid;

class TravelObserver
{

    public function creating(Travel $travel): void
    {
        $travel->id = (string) Str::uuid();
        $travel->created_by = auth()->user()->id;
    }

    /**
     * Handle the Travel "created" event.
     */
    public function created(Travel $travel): void
    {
        //
    }

    /**
     * Handle the Travel "updated" event.
     */
    public function updated(Travel $travel): void
    {
        //
    }

    /**
     * Handle the Travel "deleted" event.
     */
    public function deleted(Travel $travel): void
    {
        //
    }

    /**
     * Handle the Travel "restored" event.
     */
    public function restored(Travel $travel): void
    {
        //
    }

    /**
     * Handle the Travel "force deleted" event.
     */
    public function forceDeleted(Travel $travel): void
    {
        //
    }
}
