<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\Travel;
use App\Observers\TicketObserver;
use App\Observers\TravelObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Config::set('terbilang.locale', 'id');
        Paginator::useBootstrap();
        Travel::observe(TravelObserver::class);
        Ticket::observe(TicketObserver::class);
    }
}
