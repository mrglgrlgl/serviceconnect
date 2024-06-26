<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/address', [RegisteredUserController::class, 'showAddressForm'])->name('address.create');
    Route::post('/address', [RegisteredUserController::class, 'storeAddress'])->name('address.store');
});

require __DIR__.'/auth.php';
// // Route::get('/address/{userId}', [RegisteredUserController::class, 'showAddressForm'])->name('address.create');
// Route::post('/address', [RegisteredUserController::class, 'storeAddress'])->name('address.store');
