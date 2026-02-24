<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
        Route::post('/items/store', [ItemController::class, 'storeItem'])->name('items.store');
        Route::get('/inventory/create', [ItemController::class, 'addItem'])->name('items.add');

        Route::get('/inventory/add', [InventoryController::class, 'add'])->name('inventory.add');
        Route::post('/inventory/add/stock', [InventoryController::class, 'addStoreStock'])->name('inventory.add.stock');
        Route::get('/inventory/deduct', [InventoryController::class, 'deduct'])->name('inventory.deduct');
        Route::post('/inventory/deduct/stock', [InventoryController::class, 'deductStoreStock'])->name('inventory.deduct.stock');
    }
);

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

require __DIR__ . '/settings.php';
