<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;
use App\Http\Controllers\Auth\ServiceController;
use App\Http\Controllers\Auth\RequestController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/chat', function () {
    return view('chat'); // Replace with your chat view or logic
})->name('chat');

Route::get('/become-provider', function () {
    return view('auth.become_provider');
})->name('become-provider');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    

    // SERVICE REQUEST -> Waay pa ni unod controller
    Route::post('/service/request', [ServiceRequestController::class, 'store'])->name('service.request');

    // Route::get('/address/{userId}', [RegisteredUserController::class, 'showAddressForm'])->name('address.create'); // Define the route with 'address.create' name
    // Route::post('/address', [AddressController::class, 'store'])->name('address.store'); // Assuming AddressController has a 'store' method
});


require __DIR__.'/auth.php';
