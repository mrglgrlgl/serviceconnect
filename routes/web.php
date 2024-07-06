<?php
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;



Route::get('/', function (){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','normal'])->name('dashboard');

Route::get('/provider/dashboard', function () {
    return view('provider.dashboard');
})->middleware(['auth', 'verified','provider'])->name('provider.dashboard');

Route::get('/authorizer/dashboard', function () {
    return view('authorizer.dashboard');
})->middleware(['auth', 'verified','authorizer'])->name('authorizer.dashboard');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/chat', function () {
    return view('chat'); 
})->name('chat');

Route::get('/become-provider', function () {
    return view('auth.become_provider');
})->name('become-provider');

Route::middleware('auth')->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');

    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
    Route::post('/becomeprovider', [RequestController::class, 'store'])->name('becomeprovider');

// Example web.php route definitions
Route::post('/requests/{requestList}/accept', [RequestController::class, 'accept'])->name('requests.accept');
Route::post('/requests/{requestList}/decline', [RequestController::class, 'decline'])->name('requests.decline');


    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
 
    Route::get('/authorizer/dashboard', [RequestController::class, 'index'])->middleware(['auth', 'verified','authorizer'])->name('authorizer.dashboard');
Route::post('/requests/{request}/accept', [RequestController::class, 'accept'])->name('requests.accept');

    
}); 

require __DIR__.'/auth.php';
