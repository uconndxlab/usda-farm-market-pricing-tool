<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceEntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PriceEntryController::class, 'showDashboard'])
	->middleware(['auth', 'verified'])
	->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
	Route::get('/price-entry/{id}', [PriceEntryController::class, 'showPrice'])->name('price-entry.show');
	Route::delete('/price-entry/{id}', [PriceEntryController::class, 'deletePrice'])->name('price-entry.delete');
	Route::get('/set-location', [PriceEntryController::class, 'setLocation'])->name('set-location');
	Route::post('/set-location', [PriceEntryController::class, 'storeLocation'])->name('set-location.store');
	Route::get('/reset-location', [PriceEntryController::class, 'resetLocation'])->name('set-location.reset');
	Route::get('/price-entry', [PriceEntryController::class, 'index'])->name('price-entry.index');
	Route::post('/price-entry', [PriceEntryController::class, 'storePrice'])->name('price-entry.store');
	Route::get('/price-entry/{id}', [PriceEntryController::class, 'showPrice'])->name('price-entry.show');
});

require __DIR__.'/auth.php';
