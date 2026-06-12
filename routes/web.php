<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientPortalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\ServiceComboController;
use App\Http\Controllers\PromotionController;



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
Route::middleware(['auth'])->group(function () {
    Route::resource('customers', ClientController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('quotes', QuoteController::class);
    route::post('quotes/{quote}/send', [QuoteController::class, 'send'])->name('quotes.send');
        Route::resource('subscriptions', SubscriptionsController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('clients', ClientController::class);
    Route::get('profile', [ClientController::class, 'profile'])->name('clients.profile');
    Route::put('profile', [ClientController::class, 'updateProfile'])->name('clients.update');

    Route::resource('products', ProductController::class);
    // Items
Route::post('products/{product}/items', [ProductItemController::class, 'store']);
Route::delete('items/{item}', [ProductItemController::class, 'destroy']);

// Prices
Route::post('products/{product}/prices', [ProductPriceController::class, 'store']);

    // Service Combos
    Route::resource('combos', ServiceComboController::class);
    Route::post('combos/{combo}/toggle', [ServiceComboController::class, 'toggle'])->name('combos.toggle');

    // Promotions
    Route::resource('promotions', PromotionController::class);
    Route::post('promotions/{promotion}/toggle', [PromotionController::class, 'toggle'])->name('promotions.toggle');



    
});
Route::get('/client-portal/accept/{token}', [ClientController::class, 'accept'])->name('client.invitation.accept')->middleware('signed');