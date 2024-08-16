<?php
// use App\Http\Controllers\RequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;
// use App\Http\Controllers\Auth\BecomeProviderController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\ServiceRequestController;
use App\Http\Controllers\ProviderDashboardController;
use App\Http\Controllers\Auth\ProviderSRController;
use App\Http\Controllers\Auth\BidController;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RedirectionController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ProviderProfileController;
use App\Http\Controllers\Auth\PhilIDController;
use App\Http\Controllers\ViewProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DirectHireController;
use App\Http\Controllers\Auth\AdminUserController;
use App\Http\Controllers\Auth\AdminDashboardController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CreateAgencyUserController;
// Admin User Authentication Routes
Route::get('admin/login', [AdminUserController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminUserController::class, 'login']);
Route::post('admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');

// Admin Dashboard and Protected Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin_user']], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('agencies', AgencyController::class); // This creates all CRUD routes for the Agency resource
    Route::resource('agencies.users', CreateAgencyUserController::class)->scoped([
        'user' => 'id',    ]);

});




Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/direct-hire/create/{providerId}', [DirectHireController::class, 'create'])->name('direct-hire.create');
Route::post('/direct-hire/store', [DirectHireController::class, 'store'])->name('direct-hire.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/authorizer/dashboard', [PhilIDController::class, 'showAll'])->name('authorizer.dashboard');
    Route::post('/philid/{id}/accept', [PhilIDController::class, 'accept'])->name('philid.accept');
    Route::post('/philid/{id}/reject', [PhilIDController::class, 'reject'])->name('philid.reject');

       Route::get('/authorizer/reports', [ReportController::class, 'index'])->name('authorizer.reports');

});

Route::get('/view-profile/{providerId}', [ViewProfileController::class, 'show'])->name('view-profile');

// Route::middleware(['auth', 'verified',])->group(function () {
//     Route::get('/authorizer/dashboard', [PhilIDController::class, 'showAll'])->name('authorizer.dashboard');
// });

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Route to show the provider's profile
// Route::get('/provider/profile', [ViewProfileController::class, 'edit'])->name('provider.profile.edit');

// // Route to update the provider's profile
// Route::post('/provider/profile/update', [ViewProfileController::class, 'update'])->name('provider.profile.update');
Route::view('/terms', 'terms')->name('terms');


Route::middleware(['auth'])->group(function () {
    Route::get('/philid', [PhilIDController::class, 'index'])->name('philid.index');
    Route::get('/philid/create', [PhilIDController::class, 'create'])->name('philid.create');
    Route::post('/philid', [PhilIDController::class, 'store'])->name('philid.store');
});

Route::post('/ratings', [RatingController::class, 'store'])->name('submit.rating');
Route::post('/seeker/rate-provider', [RatingController::class, 'storeSeekerRating'])->name('submit.seeker.rating');

// Outside the auth middleware group
Route::get('/channel/{channel}', [ChannelController::class, 'showChannel'])->name('channel.show');
Route::post('/channel/{channel}/inform-seeker-on-the-way', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');
// Route::get('/channel/seeker/{serviceRequestId}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');

Route::get('/provider-channel/{serviceRequestId}', [ChannelController::class, 'providerChannel'])->name('provider-channel');

// Removed duplicate definitions
// Route::get('/provider-channel/{serviceRequestId}', [App\Http\Controllers\ChannelController::class, 'providerChannel'])->name('provider-channel');
// Route::get('/seeker-channel/{serviceRequestId}', [App\Http\Controllers\ChannelController::class, 'seekerChannel'])->name('seeker-channel');

Route::middleware(['auth'])->group(function () {
    Route::post('/bids/{bidId}/edit', [ChannelController::class, 'editBid'])->name('bids.edit');


    Route::post('/channel/{channel}/set-arrived', [App\Http\Controllers\ChannelController::class, 'setArrived'])->name('channel.setArrived');
    Route::post('/channel/{channel}/confirm-arrival', [App\Http\Controllers\ChannelController::class, 'confirmArrival'])->name('channel.confirmArrival');
    Route::post('/channel/{channel}/start-task', [App\Http\Controllers\ChannelController::class, 'startTask'])->name('channel.startTask');
    Route::post('/channel/{channel}/complete-task', [App\Http\Controllers\ChannelController::class, 'completeTask'])->name('channel.completeTask');
    Route::post('/channel/{channel}/inform-seeker-on-the-way', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');
    Route::get('/channel/seeker/{serviceRequestId}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');
    
    Route::post('/channel/{channel}/confirm-task-start', [App\Http\Controllers\ChannelController::class, 'confirmTaskStart'])->name('channel.confirmTaskStart');
    Route::post('/channel/{channel}/complete-task', [ChannelController::class, 'completeTask'])->name('channel.completeTask');
    Route::post('/channel/{channel}/confirm-task-completion', [ChannelController::class, 'confirmTaskCompletion'])->name('channel.confirmTaskCompletion');
    Route::post('/channel/{channel}/confirm-payment', [ChannelController::class, 'confirmPayment'])->name('channel.confirmPayment');
});

// Route::post('/channel/{channel}/inform-seeker', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/providers/{id}', [SearchController::class, 'show']);

    Route::get('/provider-search', [SearchController::class, 'search'])->name('provider.search');
});
// Route::group(['middleware' => ['auth', 'seeker']], function() {
//     // Route::get('/seeker/dashboard', [SeekerController::class, 'dashboard'])->name('seeker.dashboard');
//     // Other seeker routes
// });

// Route::group(['middleware' => ['auth', 'provider']], function() {
//     Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
//     // Other provider routes
// });

// Route::group(['middleware' => ['auth', 'authorizer']], function() {
//     Route::get('/authorizer/dashboard', [AuthorizerController::class, 'dashboard'])->name('authorizer.dashboard');
//     // Other authorizer routes
// });

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
// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified','normal'])->name('dashboard');

// Route::get('/provider/dashboard', function () {
//     return view('provider.dashboard');
// })->middleware(['auth', 'verified','provider'])->name('provider.dashboard');

// Route::get('/authorizer/dashboard', function () {
//     return view('authorizer.dashboard');
// })->middleware(['auth', 'verified','authorizer'])->name('authorizer.dashboard');

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
    // Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');

    // Route::get('/profile/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

    // Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
    // Route::post('/becomeprovider', [RequestController::class, 'store'])->name('becomeprovider');

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
// Route::post('/requests/{requestList}/accept', [RequestController::class, 'accept'])->name('requests.accept');
// Route::post('/requests/{requestList}/decline', [RequestController::class, 'decline'])->name('requests.decline');


    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
 
    // Route::get('/authorizer/dashboard', [RequestController::class, 'index'])->middleware(['auth', 'verified','authorizer'])->name('authorizer.dashboard');

    // For approved and pending requests
    // Route::get('/authorizer/dashboard', [RequestController::class, 'dashboard'])->name('authorizer.dashboard');
// Route::post('/requests/{request}/accept', [RequestController::class, 'accept'])->name('requests.accept');
//become provider
// Route::get('/become-provider', [BecomeProviderController::class, 'index'])->name('become-provider');
// Route::post('/save-step1', [BecomeProviderController::class, 'saveStep1'])->name('save-step1');
// Route::get('/bp_step2', [BecomeProviderController::class, 'showStep2Form'])->name('bp_step2');

// Route::post('/save-step2', [BecomeProviderController::class, 'saveStep2'])->name('save-step2');
// Route::get('/bp_step3', [BecomeProviderController::class, 'showStep3Form'])->name('bp_step3');
// Route::post('/save-step3', [BecomeProviderController::class, 'saveStep3'])->name('save-step3');

Route::middleware('auth')->group(function () {
    Route::get('/profile/view', [App\Http\Controllers\Auth\ProviderProfileController::class, 'show'])->name('profile.view');
    Route::get('/seekerprofile', [ProfileController::class, 'seekerProfile'])->name('seekerprofile');
    Route::get('/profile/edit', [App\Http\Controllers\Auth\ProviderProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [App\Http\Controllers\Auth\ProviderProfileController::class, 'update'])->name('profile.update');
});


Route::post('/profilecreate', [ProviderProfileController::class, 'saveProfileCreate'])->name('profilecreate');
Route::get('/profilecreate', [ProviderProfileController::class, 'index'])->name('create-profile');
// Route::post('/profilecreate', [ProviderProfileController::class, 'store'])->name('profilecreate');
Route::post('/save-profile', [ProviderProfileController::class, 'saveProfileCreate'])->name('save-profile');

Route::get('/certifications', [ProviderProfileController::class, 'showCertificationsForm'])->name('certifications');
Route::post('/certifications', [ProviderProfileController::class, 'saveCertifications'])->name('certifications.save');
// Route for handling the form submission

// Route::post('/save-profile', [ProviderProfileController::class, 'saveProfileCreate'])->name('save-profile');
// Route::get('/verify/certifications', [ProviderProfileController::class, 'showCertificationsForm'])->name('auth.verify.profile.certifications');
// Route::post('/verify/certifications', [ProviderProfileController::class, 'saveCertifications']);

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
Route::post('/dashboard', [ServiceRequestController::class, 'checkBidAmount'])->name('dashboard.checkBidAmount');
// Resource routes for service requests

Route::middleware('auth')->group(function () {
    Route::get('/provider/dashboard', [ServiceRequestController::class, 'retrieveByUserRole'])->name('provider.dashboard');
});
Route::get('/provider/myrequests', [ServiceRequestController::class, 'myRequests'])->name('provider.myrequests');


Route::get('/service-requests', [ServiceRequestController::class, 'index'])->name('service-requests.index');
// Route::post('/service-requests', [ServiceRequestController::class, 'store'])->name('service-requests.store');
// Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');
// Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');
// Route::patch('/service-requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('service-requests.update');
// Route::get('/service-requests/{id}/edit', 'ServiceRequestController@edit')->name('service-requests.edit');

Route::patch('/service-requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('service-requests.update');
Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');






// Route::delete('/service-requests/{id}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');
Route::delete('/service-requests/{service_request}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

// routes/web.php
Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
// Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
Route::post('/bids/{bid}/confirm', [BidController::class, 'confirm'])->name('bids.confirm');

Route::patch('bids/{id}', [BidController::class, 'update'])->name('bids.update');
Route::get('/bids/update/{id}', [BidController::class, 'update'])->name('bidders-profile');

// Route::patch('/bids/update/{id}', [BidController::class, 'update'])->name('bids.update');
// Route::get('/bids/update/{id}', [BidController::class, 'update'])->name('bids.update');


Route::get('/chat', function () {return view('chat');})->name('chat');

Route::get('/api/providers/{bidderId}', [BidController::class, 'getProviderProfile']);
Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');


// Route for confirming a bid
// Route for seekers
// Route::get('/seeker-channel/{serviceRequest}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');

// Route for providers

// Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

// Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

}); 
Route::get('/profile/complete', [BidController::class, 'complete'])->name('profile.complete');
Route::get('/profile/view', [ProfileController::class, 'profile'])->name('profile.view')->middleware('auth');


// analytics
Route::get('/analytics', [AnalyticsController::class, 'seekeranalytics'])
    ->middleware(['auth', 'verified'])
    ->name('analytics');

// Define route for provider analytics with appropriate middleware
Route::get('/provider-analytics', [AnalyticsController::class, 'provideranalytics'])
    ->middleware(['auth', 'verified'])
    ->name('provider.analytics');


require __DIR__.'/auth.php';