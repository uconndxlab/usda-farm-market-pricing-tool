<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceEntryController;
use App\Http\Controllers\LocationController;

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

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Location routes
Route::middleware('auth')->group(function () {
	Route::get('/set-location', [LocationController::class, 'index'])->name('location.index');
	Route::post('/set-location', [LocationController::class, 'store'])->name('location.store');
	Route::get('/reset-location', [LocationController::class, 'reset'])->name('location.reset');
});

// Price entry routes
Route::middleware('auth')->group(function () {
	Route::get('/price-entry/export', [PriceEntryController::class, 'exportAllEntriesToCsv'])->name('price-entry.export');

	Route::get('/price-entry/all', [PriceEntryController::class, 'showAllEntries'])->name('price-entry.all');

	Route::get('/price-entry/{id}', [PriceEntryController::class, 'showPrice'])->name('price-entry.show');
	Route::delete('/price-entry/{id}', [PriceEntryController::class, 'deletePrice'])->name('price-entry.delete');
	Route::get('/price-entry', [PriceEntryController::class, 'index'])->middleware('check.town')->name('price-entry.index');
	Route::post('/price-entry', [PriceEntryController::class, 'storePrice'])->middleware('check.town')->name('price-entry.store');
});

require __DIR__.'/auth.php';
