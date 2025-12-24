<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\PurchaseOrderController;
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

    Route::middleware(['auth'])->group(function () {

        Route::get('/inventory', [InventoryController::class, 'index'])
            ->name('inventory.index');

        Route::get('/inventory/stock-in', [InventoryController::class, 'createIn'])
            ->name('inventory.stock-in');

        Route::post('/inventory/stock-in', [InventoryController::class, 'storeIn'])
            ->name('inventory.stock-in.store');

        Route::get('/inventory/stock-out', [InventoryController::class, 'createOut'])
            ->name('inventory.stock-out');

        Route::post('/inventory/stock-out', [InventoryController::class, 'storeOut'])
            ->name('inventory.stock-out.store');
    });

    Route::middleware(['auth'])->group(function () {

        Route::resource('purchase-requests', PurchaseRequestController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::post(
            'purchase-requests/{purchaseRequest}/submit',
            [PurchaseRequestController::class, 'submit']
        )->name('purchase-requests.submit');

        Route::post(
            'purchase-requests/{purchaseRequest}/approve',
            [PurchaseRequestController::class, 'approve']
        )->name('purchase-requests.approve');

        Route::post(
            'purchase-requests/{purchaseRequest}/reject',
            [PurchaseRequestController::class, 'reject']
        )->name('purchase-requests.reject');
    });

    Route::middleware(['auth'])->group(function () {

        Route::resource('purchase-orders', PurchaseOrderController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::post(
            'purchase-orders/{purchaseOrder}/submit',
            [PurchaseOrderController::class, 'submit']
        )->name('purchase-orders.submit');

        Route::post(
            'purchase-orders/{purchaseOrder}/approve',
            [PurchaseOrderController::class, 'approve']
        )->name('purchase-orders.approve');
    });
});

require __DIR__ . '/auth.php';
