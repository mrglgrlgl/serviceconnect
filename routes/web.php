<?php
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\ServiceRequestController;
use App\Http\Controllers\Auth\RequestController;



=======
use App\Http\Controllers\Auth\BecomeProviderController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


>>>>>>> 1f959e92dfaa6d6d2b6fff7569406ddfc44274f5
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

<<<<<<< HEAD
Route::get('/become-provider', function () {
    return view('auth.become-provider');
})->name('become-provider');

=======
// Route::get('/become-provider', function () {
//     return view('auth.multistep.become_provider');
// })->name('become-provider');
>>>>>>> 1f959e92dfaa6d6d2b6fff7569406ddfc44274f5

Route::middleware('auth')->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');

    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
<<<<<<< HEAD
    Route::get('/becomeprovider', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'yourMethod'])->name('becomeprovider');

    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
}); 

    // SERVICE REQUEST -> Waay pa ni unod controller
    Route::post('/service/request', [ServiceRequestController::class, 'show'])->name('service.request');
=======
    Route::post('/becomeprovider', [RequestController::class, 'store'])->name('becomeprovider');

// Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
// Route::post('/becomeprovider', [BecomeProviderController::class, 'store'])->name('becomeprovider.store');

Route::get('provider-documents/{filename}', function ($filename) {
    $path = storage_path('app/provider/documents/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('provider.documents');
// // Example web.php route definitions
Route::post('/requests/{requestList}/accept', [RequestController::class, 'accept'])->name('requests.accept');
Route::post('/requests/{requestList}/decline', [RequestController::class, 'decline'])->name('requests.decline');


    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
 
    Route::get('/authorizer/dashboard', [RequestController::class, 'index'])->middleware(['auth', 'verified','authorizer'])->name('authorizer.dashboard');
Route::post('/requests/{request}/accept', [RequestController::class, 'accept'])->name('requests.accept');
//become provider
Route::get('/become-provider', [BecomeProviderController::class, 'index'])->name('become-provider');
Route::post('/save-step1', [BecomeProviderController::class, 'saveStep1'])->name('save-step1');
Route::get('/bp_step2', [BecomeProviderController::class, 'showStep2Form'])->name('bp_step2');

Route::post('/save-step2', [BecomeProviderController::class, 'saveStep2'])->name('save-step2');
Route::get('/bp_step3', [BecomeProviderController::class, 'showStep3Form'])->name('bp_step3');
Route::post('/save-step3', [BecomeProviderController::class, 'saveStep3'])->name('save-step3');

}); 
>>>>>>> 1f959e92dfaa6d6d2b6fff7569406ddfc44274f5

require __DIR__.'/auth.php';
