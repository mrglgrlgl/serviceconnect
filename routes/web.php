<?php
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;
use App\Http\Controllers\Auth\BecomeProviderController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\ServiceRequestController;
use App\Http\Controllers\Auth\ProviderSRController;
use App\Http\Controllers\Auth\BidController;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RedirectionController;
use App\Http\Controllers\ChannelController;


Route::group(['middleware' => ['auth', 'seeker']], function() {
    Route::get('/seeker/dashboard', [SeekerController::class, 'dashboard'])->name('seeker.dashboard');
    // Other seeker routes
});

Route::group(['middleware' => ['auth', 'provider']], function() {
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
    // Other provider routes
});

Route::group(['middleware' => ['auth', 'authorizer']], function() {
    Route::get('/authorizer/dashboard', [AuthorizerController::class, 'dashboard'])->name('authorizer.dashboard');
    // Other authorizer routes
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/', function (){
    return view('welcome');
});

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');

Route::get('/register/provider', function (Request $request) {
    $request->session()->put('user_role', 2); // Set role 2 for providers in session
    return redirect()->route('register');
})->name('register.provider');

Route::get('/register-as', [App\Http\Controllers\Auth\RegisteredUserController::class, 'registerAs'])->name('registerAs');

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);


Route::get('/register-as', function () {
    return view('auth.registerAs');
})->name('registerAs');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
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

// Route::get('/become-provider', function () {
//     return view('auth.multistep.become_provider');
// })->name('become-provider');

Route::middleware('auth')->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');

    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
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
// Route::post('/requests/{request}/accept', [RequestController::class, 'accept'])->name('requests.accept');
//become provider
Route::get('/become-provider', [BecomeProviderController::class, 'index'])->name('become-provider');
Route::post('/save-step1', [BecomeProviderController::class, 'saveStep1'])->name('save-step1');
Route::get('/bp_step2', [BecomeProviderController::class, 'showStep2Form'])->name('bp_step2');

Route::post('/save-step2', [BecomeProviderController::class, 'saveStep2'])->name('save-step2');
Route::get('/bp_step3', [BecomeProviderController::class, 'showStep3Form'])->name('bp_step3');
Route::post('/save-step3', [BecomeProviderController::class, 'saveStep3'])->name('save-step3');

// Store service requests
Route::get('service-requests/create', [ServiceRequestController::class, 'create'])->name('service-requests.create');
Route::post('service-requests', [ServiceRequestController::class, 'store'])->name('service-requests.store');
// Route for displaying a success page or a modal (example route)
Route::get('service-request/success', function() {
    return view('layouts.modal');  // Assuming `layouts.modal` is the correct view
})->name('service-requests.success');
// Route to display the dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ServiceRequestController::class, 'index'])->name('dashboard');
    // Other authenticated routes...
});
// Resource routes for service requests

Route::middleware('auth')->group(function () {
    Route::get('/provider/dashboard', [ServiceRequestController::class, 'retrieveByUserRole'])->name('provider.dashboard');
});
Route::get('/service-requests', [ServiceRequestController::class, 'index'])->name('service-requests.index');
Route::post('/service-requests', [ServiceRequestController::class, 'store'])->name('service-requests.store');
Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');
Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');
Route::patch('/service-requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('service-requests.update');
Route::get('/service-requests/{id}/edit', 'ServiceRequestController@edit')->name('service-requests.edit');
Route::delete('/service-requests/{id}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');
Route::delete('/service-requests/{service_request}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

// routes/web.php
Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
// Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
Route::post('/bids/{bid}/confirm', [BidController::class, 'confirm'])->name('bids.confirm');

Route::patch('/bids/update/{id}', [BidController::class, 'update'])->name('bids.update');
Route::get('/bids/update/{id}', [BidController::class, 'update'])->name('bids.update');


Route::get('/chat', function () {return view('chat');})->name('chat');

Route::get('/api/providers/{bidderId}', [BidController::class, 'getProviderProfile']);
Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');


// Route for confirming a bid
// Route for seekers
Route::get('/seeker-channel/{serviceRequest}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');

// Route for providers
Route::get('/provider-channel', [ChannelController::class, 'providerChannel'])->name('channel.provider');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

}); 


require __DIR__.'/auth.php';