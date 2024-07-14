<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ProviderDetail;
use App\Models\RequestList;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    public function index()
    {
        $requests = RequestList::with(['user', 'providerDetail'])->get();

    
        return view('authorizer.dashboard', compact('requests'));
    }
    

    public function store(HttpRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'status' => 'required|string',
            
        ]);
     // Create a new request
     $requestList = RequestList::create($validatedData);

     // Return the created RequestList instance
     return $requestList;
        // Create a new request
        // $requestList = RequestList::create($validatedData);
    
        // // Return a response, such as a JSON response
        // return response()->json(['message' => 'Request created successfully.'], 201);
    }

    public function accept(HttpRequest $request, RequestList $requestList)
    {
        // Ensure the request has the required user_id
        if (!$requestList->user_id) {
            return redirect()->route('dashboard')->with('error', 'User ID is missing.');
        }
    
        // Update the status of the request
        $requestList->status = 'approved';
        $requestList->save();
    
        // Find the user associated with the request
        $user = User::find($requestList->user_id);
    
        if (!$user) {
            Log::error('User not found for ID: ' . $requestList->user_id);
            return redirect()->route('dashboard')->with('error', 'User not found.');
        }
    
        // Update the user's role to 2 (or your desired role)
        $user->update(['role' => 2]); // Assuming '2' is your desired role value
        $user->save();
    
        // Find the ProviderDetail associated with the request
        $providerDetail = ProviderDetail::where('request_id', $requestList->id)->first();
    
        if ($providerDetail) {
            // Update the status of the ProviderDetail
            $providerDetail->status = 'approved';
            $providerDetail->save();
        } else {
            Log::error('ProviderDetail not found for request ID: ' . $requestList->id);
        }
    
        Log::info('User role updated successfully and ProviderDetail status updated.');
    
        // Redirect or return a response
        return redirect()->route('authorizer.dashboard')->with('success', 'Request accepted successfully and user role updated.');
    }
    


    public function decline(HttpRequest $request, RequestList $requestList)
    {
        // Ensure the request has the required user_id
        if (!$requestList->user_id) {
            return redirect()->route('authorizer.dashboard')->with('error', 'User ID is missing.');
        }

        // Update the status of the request
        $requestList->status = 'rejected';
        $requestList->save();
    
        // Redirect or return a response
        return redirect()->route('authorizer.dashboard')->with('success', 'Request declined successfully.');
    }
}