<?php

use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('travels.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/travels/{travel}/print', [PerjalananController::class, 'print'])->name('travels.print');
    Route::get('travels/getTravelsByDate', [PerjalananController::class, 'getTravelsByDate'])->name('travels.getTravelsByDate');
    Route::get('/travel/{travel}/seats', [PerjalananController::class, 'seats']);
    Route::delete('/tickets/multiple', [TicketController::class, 'destroyMultiple'])->name('tickets.destroyMultiple');
    Route::resource('travels', PerjalananController::class);
    Route::resource('tickets', TicketController::class);
});

Route::get('/layout', function () {
    return view('layouts.layout');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
