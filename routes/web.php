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
use App\Http\Controllers\EmployeeTaskAssignmentController;
use App\Http\Controllers\PsaJobController;

Route::get('/agency-profile/{agencyId}', [SearchController::class, 'viewAgencyProfile'])->name('view-agency-profile');
Route::post('/cancel-request/{channel}', [ChannelController::class, 'cancelRequest'])->name('cancel.request');


Route::get('/login', function () {
    return view('login'); // Your login.blade.php
})->name('login');


Route::get('/profile/{agencyUserId}', [BidController::class, 'viewProfile'])->name('view-profile');


// Admin User Authentication Routes
Route::get('admin/login', [AdminUserController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminUserController::class, 'login']);
Route::post('admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');

// Admin Dashboard and Protected Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin_user']], function () {
   

// Routes for managing PSA jobs
Route::get('/psajobs', [PsaJobController::class, 'index'])->name('admin.psajobs.index'); // List all PSA jobs
Route::post('/psajobs', [PsaJobController::class, 'store'])->name('admin.psajobs.store'); // Store a new PSA job
Route::get('/psajobs/{id}/edit', [PsaJobController::class, 'edit'])->name('admin.psajobs.edit'); // Edit a specific PSA job
Route::put('/psajobs/{id}', [PsaJobController::class, 'update'])->name('admin.psajobs.update'); // Update a specific PSA job
Route::delete('/psajobs/{id}', [PsaJobController::class, 'destroy'])->name('admin.psajobs.destroy'); // Delete a specific PSA job
   
    Route::get('/admin/agency/service-update/{id}', [AdminAgencyReviewController::class, 'showServiceUpdate'])->name('admin.agency.service.update.show');

    Route::post('/agency/service-update/{id}/approve', [AdminAgencyReviewController::class, 'approveServiceUpdate'])
        ->name('admin.agency.service.update.approve');

        Route::get('admin/agencies/{agency}', [AdminAgencyReviewController::class, 'show'])->name('admin.agencies.show');
        Route::get('/agency/service-updates', [AdminAgencyReviewController::class, 'index'])
        ->name('admin.agency.service.updates');
    


    Route::post('/agency/service-update/{id}/reject', [AdminAgencyReviewController::class, 'rejectServiceUpdate'])->name('admin.agency.service.update.reject');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('agencies', AgencyController::class); // This creates all CRUD routes for the Agency resource
    Route::resource('agencies.users', CreateAgencyUserController::class)->scoped([
        'user' => 'id',    ]);
 Route::delete('admin/agencies/{agency}/users/{user}', [CreateAgencyUserController::class, 'destroy'])
        ->name('agencies.users.destroy');

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


    Route::put('/channel/{channel}/employee/{employee}', [ChannelController::class, 'unassignEmployee'])->name('unassign.employee');
    Route::post('/agency/confirm-cancellation', [ChannelController::class, 'confirmCancellation'])->name('confirm.cancellation');


// Route to show the assignment page
Route::post('/agency/assign/employees/{channel_id}', [EmployeeTaskAssignmentController::class, 'assign'])->name('assign.employees');

Route::get('/assign-employees/{serviceRequestId}', [EmployeeTaskAssignmentController::class, 'showAssignmentPage'])->name('show.assignment.page');

// Route to handle form submission
    Route::post('/complete-assignment/{id}', [EmployeeTaskAssignmentController::class, 'complete'])->name('complete.assignment');
    // Route::post('/remove-employee/{id}', [EmployeeTaskAssignmentController::class, 'remove'])->name('remove.employee');
    
    Route::post('/bids/{bidId}/edit', [ChannelController::class, 'editBid'])->name('bids.edit');
    Route::get('/agency-channel/{serviceRequestId}', [ChannelController::class, 'agencyChannel'])->name('channel.agency');
    // Route::get('/agency-channel/{serviceRequestId}', [ChannelController::class, 'agencyChannel'])->name('channel.agency');
    // Agency user-specific actions for the channel
    Route::get('/channel/{channel}', [ChannelController::class, 'showChannel'])->name('channel.show');

    Route::post('/channel/{channel}/set-arrived', [ChannelController::class, 'setArrived'])->name('channel.setArrived');
    Route::post('/channel/{channel}/start-task', [ChannelController::class, 'startTask'])->name('channel.startTask');
        Route::post('/channel/{channel}/confirm-task-completion', [ChannelController::class, 'confirmTaskCompletion'])->name('channel.confirmTaskCompletion');

    Route::post('/channel/{channel}/confirm-payment', [ChannelController::class, 'confirmPayment'])->name('channel.confirmPayment');

    // Agency user channel view

    Route::get('/provider/filter-requests', [ServicerequestController::class, 'filterServiceRequests'])->name('provider.filterRequests');


    Route::get('/bids/create/{id}', [BidController::class, 'create'])->name('bids.create');
    Route::post('/place-bid', [BidController::class, 'store'])->name('bids.store');
   Route::get('/placebid/{id}', [BidController::class, 'show'])->name('placebid');
   Route::get('/service-requests', [ServiceRequestController::class, 'retrieveByUserRole'])->name('agencyuser.service-requests');

//Agency Services

    Route::get('/{agency}/settings', [AgencyServiceController::class, 'index'])->name('agencyservice.settings');
    Route::post('/{agency}/services', [AgencyServiceController::class, 'store'])->name('agencies.services.store');
    Route::get('/{agency}/services/create', [AgencyServiceController::class, 'create'])->name('agencies.services.create');
// Define routes with proper parameters
    Route::get('agencies/{agency}/services/{service}/edit', [AgencyServiceController::class, 'edit'])
    ->name('agencies.services.edit');
    Route::put('agencies/{agency}/services/{service}', [AgencyServiceController::class, 'update'])->name('agencies.services.update');
    Route::delete('agencies/{agency}/services/{service}', [AgencyServiceController::class, 'destroy'])->name('agencies.services.destroy');



    Route::get('/employees', [EmployeeController::class, 'index'])->name('agency.employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('agency.employees.create');


    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('agency.employees.show');

    // Store the new employee in the database
    Route::post('/employees', [EmployeeController::class, 'store'])->name('agency.employees.store');

    // Show the form to edit an existing employee
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('agency.employees.edit');

    // Update an existing employee in the database
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('agency.employees.update');

    // Delete an employee from the database
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('agency.employees.destroy');
    


    Route::get('/home', [AnalyticsController::class, 'providerAnalytics'])->name('agency.home');





    // Service Requests
    Route::get('/requests', function () {
        return view('agencyuser.service-requests');
    })->name('agency.requests');

    // Reports
    // Route::get('/reports', function () {
    //    return view('agencyuser.reports');
    // })->name('agency.reports');
    
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Feedbacks
    Route::get('/feedback', [RatingController::class, 'index'])->name('agency.feedback');


    // Agency Settings
    Route::get('/settings', [AgencySettingsController::class, 'showSettings'])->name('agency.settings');
    Route::get('/settings/edit', [AgencySettingsController::class, 'editSettings'])->name('agency.settings.edit');
    Route::put('/settings', [AgencySettingsController::class, 'updateSettings'])->name('agency.settings.update');
    
    Route::get('/analytics', [AnalyticsController::class, 'providerAnalytics'])->name('agency.analytics');



    Route::get('/requests', [ServiceRequestController::class, 'retrieveByUserRole'])->name('agency.requests');


Route::get('/agency/requests/search', [PsaJobController::class, 'search'])->name('agency.requests.search');

});
    // Route::post('/requests', [ServiceRequestController::class, 'store'])->name('agency.requests.store');
    // Route::get('/requests/{serviceRequest}/edit', [ServiceRequestController::class, 'edit'])->name('agency.requests.edit');
    // Route::patch('/requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('agency.requests.update');
    // Route::delete('/requests/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('agency.requests.destroy');

    


// contact info
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');


// Route::middleware('auth')->group(function () {
//     // Other routes...

//     // Agency analytics route
//     Route::get('/agency/analytics', [AnalyticsController::class, 'agencyanalytics'])->name('agency.analytics');
// });



Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/direct-hire/create/{providerId}', [DirectHireController::class, 'create'])->name('direct-hire.create');
Route::post('/direct-hire/store', [DirectHireController::class, 'store'])->name('direct-hire.store');





Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::view('/terms', 'terms')->name('terms');




Route::post('/ratings', [RatingController::class, 'store'])->name('submit.rating');
Route::post('/seeker/rate-provider', [RatingController::class, 'storeSeekerRating'])->name('submit.seeker.rating');

// Outside the auth middleware group
// Route::get('/channel/{channel}', [ChannelController::class, 'showChannel'])->name('channel.show');
Route::post('/channel/{channel}/inform-seeker-on-the-way', [ChannelController::class, 'informSeekerOnTheWay'])->name('channel.informSeekerOnTheWay');



Route::middleware(['auth'])->group(function () {



    Route::post('/channel/{channel}/confirm-arrival', [App\Http\Controllers\ChannelController::class, 'confirmArrival'])->name('channel.confirmArrival');

    Route::get('/channel/seeker/{serviceRequestId}', [ChannelController::class, 'seekerChannel'])->name('channel.seeker');
    
    Route::post('/channel/{channel}/confirm-task-start', [App\Http\Controllers\ChannelController::class, 'confirmTaskStart'])->name('channel.confirmTaskStart');
    // Route::post('/channel/{channel}/complete-task', [ChannelController::class, 'completeTask'])->name('channel.completeTask');
    
  Route::post('/channel/{channel}/complete-task', [ChannelController::class, 'completeTask'])->name('channel.completeTask');

    // Route::post('/channel/{channel}/confirm-payment', [ChannelController::class, 'confirmPayment'])->name('channel.confirmPayment');
//    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
});

//    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');


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

Route::get('/home', [SearchController::class, 'index'])->name('home');


Route::get('/chat', function () {
    return view('chat'); 
})->name('chat');


Route::middleware('auth')->group(function () {

//    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
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
Route::get('/seekerprofile-edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('seekerprofile-edit');
    Route::put('/seekerprofile-update', [App\Http\Controllers\ProfileController::class, 'update'])->name('seekerprofile-update');
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

Route::get('/about', [ProfileController::class, 'about'])->name('about');

// Define route for provider analytics with appropriate middleware
// Route::get('/provider-analytics', [AnalyticsController::class, 'provideranalytics'])
//     ->middleware(['auth', 'verified'])
//     ->name('provider.analytics');


require __DIR__.'/auth.php';