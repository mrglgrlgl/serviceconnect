<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AddressController;
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
use App\Http\Controllers\Auth\AgencyUserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AgencySettingsController;
use App\Http\Controllers\AdminAgencyReviewController;
use App\Http\Controllers\AgencyServiceController;


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


        Route::get('/agency-updates', [AdminAgencyReviewController::class, 'index'])->name('admin.agency.updates');
        Route::get('/agency-updates/{id}/review', [AdminAgencyReviewController::class, 'review'])->name('admin.agency.update.review');
        Route::post('/agency-updates/{id}/approve', [AdminAgencyReviewController::class, 'approve'])->name('admin.agency.update.approve');
    Route::post('/agency-updates/{id}/reject', [AdminAgencyReviewController::class, 'reject'])->name('admin.agency.update.reject');
});
// Add these to your routes/web.php

Route::get('agency/login', [AgencyUserController::class, 'showLoginForm'])->name('agency.login');
Route::post('agency/login', [AgencyUserController::class, 'login']);
Route::post('agency/logout', [AgencyUserController::class, 'logout'])->name('agency.logout');




Route::group(['prefix' => 'agency', 'middleware' => ['auth:agency_users']], function () {


    Route::post('/bids/{bidId}/edit', [ChannelController::class, 'editBid'])->name('bids.edit');
    Route::get('/agency-channel/{serviceRequestId}', [ChannelController::class, 'agencyChannel'])->name('channel.agency');
    // Route::get('/agency-channel/{serviceRequestId}', [ChannelController::class, 'agencyChannel'])->name('channel.agency');
    // Agency user-specific actions for the channel
    Route::get('/channel/{channel}', [ChannelController::class, 'showChannel'])->name('channel.show');

    Route::post('/channel/{channel}/set-arrived', [ChannelController::class, 'setArrived'])->name('channel.setArrived');
    Route::post('/channel/{channel}/start-task', [ChannelController::class, 'startTask'])->name('channel.startTask');
    Route::post('/channel/{channel}/complete-task', [ChannelController::class, 'completeTask'])->name('channel.completeTask');
    Route::post('/channel/{channel}/confirm-payment', [ChannelController::class, 'confirmPayment'])->name('channel.confirmPayment');

    // Agency user channel view

    Route::get('/provider/filter-requests', [ServicerequestController::class, 'filterServiceRequests'])->name('provider.filterRequests');


    Route::get('/bids/create/{id}', [BidController::class, 'create'])->name('bids.create');
    Route::post('/place-bid', [BidController::class, 'store'])->name('bids.store');
   Route::get('/placebid/{id}', [BidController::class, 'show'])->name('placebid');
   Route::get('/service-requests', [ServiceRequestController::class, 'retrieveByUserRole'])->name('agencyuser.service-requests');



    Route::get('/{agency}/settings', [AgencyServiceController::class, 'index'])->name('agencyservice.settings');

    Route::get('/{agency}/services/create', [AgencyServiceController::class, 'create'])->name('agencies.services.create');
    Route::post('/{agency}/services', [AgencyServiceController::class, 'store'])->name('agencies.services.store');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('agency.employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('agency.employees.create');

    // Store the new employee in the database
    Route::post('/employees', [EmployeeController::class, 'store'])->name('agency.employees.store');

    // Show the form to edit an existing employee
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('agency.employees.edit');

    // Update an existing employee in the database
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('agency.employees.update');

    // Delete an employee from the database
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('agency.employees.destroy');
    
    Route::get('/home', function () {
        return view('agencyuser.home');
    })->name('agency.home');  // Use agency.home instead of agency.dashboard

    // Service Requests
    Route::get('/requests', function () {
        return view('agencyuser.service-requests');
    })->name('agency.requests');

    // Reports
    Route::get('/reports', function () {
        return view('agencyuser.reports');
    })->name('agency.reports');

    // Analytics
    Route::get('/analytics', function () {
        return view('agencyuser.analytics');
    })->name('agency.analytics');

    // Agency Settings
    Route::get('/settings', [AgencySettingsController::class, 'showSettings'])->name('agency.settings');
    Route::get('/settings/edit', [AgencySettingsController::class, 'editSettings'])->name('agency.settings.edit');
    Route::put('/settings', [AgencySettingsController::class, 'updateSettings'])->name('agency.settings.update');
    


    Route::get('/requests', [ServiceRequestController::class, 'retrieveByUserRole'])->name('agency.requests');
    // Route::post('/requests', [ServiceRequestController::class, 'store'])->name('agency.requests.store');
    // Route::get('/requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('agency.requests.edit');
    // Route::patch('/requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('agency.requests.update');
    // Route::delete('/requests/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('agency.requests.destroy');

    
});




Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/direct-hire/create/{providerId}', [DirectHireController::class, 'create'])->name('direct-hire.create');
Route::post('/direct-hire/store', [DirectHireController::class, 'store'])->name('direct-hire.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/authorizer/dashboard', [PhilIDController::class, 'showAll'])->name('authorizer.dashboard');
    Route::post('/philid/{id}/accept', [PhilIDController::class, 'accept'])->name('philid.accept');
    Route::post('/philid/{id}/reject', [PhilIDController::class, 'reject'])->name('philid.reject');

 

});

Route::get('/view-profile/{providerId}', [ViewProfileController::class, 'show'])->name('view-profile');


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::view('/terms', 'terms')->name('terms');


Route::middleware(['auth'])->group(function () {
    Route::get('/philid', [PhilIDController::class, 'index'])->name('philid.index');
    Route::get('/philid/create', [PhilIDController::class, 'create'])->name('philid.create');
    Route::post('/philid', [PhilIDController::class, 'store'])->name('philid.store');
});

Route::post('/ratings', [RatingController::class, 'store'])->name('submit.rating');
Route::post('/seeker/rate-provider', [RatingController::class, 'storeSeekerRating'])->name('submit.seeker.rating');

// Outside the auth middleware group
// Route::get('/channel/{channel}', [ChannelController::class, 'showChannel'])->name('channel.show');
Route::post('/channel/{channel}/inform-seeker-on-the-way', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');
// Route::get('/channel/seeker/{serviceRequestId}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');

// Route::get('/provider-channel/{serviceRequestId}', [ChannelController::class, 'providerChannel'])->name('provider-channel');


Route::middleware(['auth'])->group(function () {
    // Route::post('/bids/{bidId}/edit', [ChannelController::class, 'editBid'])->name('bids.edit');


    // Route::post('/channel/{channel}/set-arrived', [App\Http\Controllers\ChannelController::class, 'setArrived'])->name('channel.setArrived');
    Route::post('/channel/{channel}/confirm-arrival', [App\Http\Controllers\ChannelController::class, 'confirmArrival'])->name('channel.confirmArrival');
    // Route::post('/channel/{channel}/start-task', [App\Http\Controllers\ChannelController::class, 'startTask'])->name('channel.startTask');
    // Route::post('/channel/{channel}/complete-task', [App\Http\Controllers\ChannelController::class, 'completeTask'])->name('channel.completeTask');
    // Route::post('/channel/{channel}/inform-seeker-on-the-way', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');
    Route::get('/channel/seeker/{serviceRequestId}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');
    
    Route::post('/channel/{channel}/confirm-task-start', [App\Http\Controllers\ChannelController::class, 'confirmTaskStart'])->name('channel.confirmTaskStart');
    // Route::post('/channel/{channel}/complete-task', [ChannelController::class, 'completeTask'])->name('channel.completeTask');
    Route::post('/channel/{channel}/confirm-task-completion', [ChannelController::class, 'confirmTaskCompletion'])->name('channel.confirmTaskCompletion');
    // Route::post('/channel/{channel}/confirm-payment', [ChannelController::class, 'confirmPayment'])->name('channel.confirmPayment');
});

// Route::post('/channel/{channel}/inform-seeker', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/providers/{id}', [SearchController::class, 'show']);

    Route::get('/provider-search', [SearchController::class, 'search'])->name('provider.search');
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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/chat', function () {
    return view('chat'); 
})->name('chat');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');


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


    Route::get('/address/create/{userId}', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
 

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

Route::patch('/service-requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('service-requests.update');
Route::get('/service-requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('service-requests.edit');






Route::delete('/service-requests/{service_request}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

// routes/web.php
Route::post('/bids', [BidController::class, 'store'])->name('provider.bids.store');
Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
// Route::get('/api/service-requests/{id}/bids', [BidController::class, 'index']);
Route::post('/bids/{bid}/confirm', [BidController::class, 'confirm'])->name('bids.confirm');

Route::patch('bids/{id}', [BidController::class, 'update'])->name('bids.update');
Route::get('/bids/update/{id}', [BidController::class, 'update'])->name('bidders-profile');



Route::get('/chat', function () {return view('chat');})->name('chat');

Route::get('/api/providers/{bidderId}', [BidController::class, 'getProviderProfile']);
Route::post('/bids/{bidId}/accept', [BidController::class, 'acceptBid'])->name('bids.accept');



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