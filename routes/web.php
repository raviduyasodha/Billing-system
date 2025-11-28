<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;

// Dashboard route
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $customerCount = \App\Models\Customer::count();
    $invoiceCount  = \App\Models\Invoice::count();

    return view('dashboard', compact('customerCount', 'invoiceCount'));
})->name('dashboard');

// Customer pages (registration + list)
Route::resource('customers', CustomerController::class)->only([
    'index', 'create', 'store'
]);

// Invoice pages (list + create + show)
Route::resource('invoices', InvoiceController::class)->only([
    'index', 'create', 'store', 'show'
]);
Route::get('/item-price', [InvoiceController::class, 'getItemPrice'])
    ->name('items.price');

Route::resource('items', ItemController::class)->only([
    'index', 'create', 'store'
]);