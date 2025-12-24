<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard.index'))
        ->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('suppliers', SupplierController::class);
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('warehouses', WarehouseController::class);
    });
});

require __DIR__ . '/auth.php';
