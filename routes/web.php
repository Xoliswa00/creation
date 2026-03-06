<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('customers', CustomerController::class);
    Route::resource('invoices', InvoiceController::class);
});