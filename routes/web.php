<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::post('/checkout', [LandingController::class, 'checkout'])->name('landing.checkout');
Route::get('/checkout-success/{code}', [LandingController::class, 'success'])->name('landing.success');
Route::get('/print-invoice/{invoice}', [LandingController::class, 'printInvoice'])->name('landing.printInvoice');

Route::get('travels/getTravelsByDate', [PerjalananController::class, 'getTravelsByDate'])->name('travels.getTravelsByDate');
Route::get('/travel/{travel}/seats', [PerjalananController::class, 'seats']);
Route::middleware('auth')->group(function () {
    Route::get('/travels/{travel}/print', [PerjalananController::class, 'print'])->name('travels.print');
    Route::delete('/tickets/multiple', [TicketController::class, 'destroyMultiple'])->name('tickets.destroyMultiple');
    Route::get('/tickets/getTicketByTravel/{travelId}', [TicketController::class, 'getTicketByTravel'])->name('tickets.getTicketByTravel');
    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::resource('travels', PerjalananController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('/invoices', InvoiceController::class);
});

Route::get('/layout', function () {
    return view('layouts.layout');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
