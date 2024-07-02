<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    public function store(HttpRequest $request)
    {
        // Log the incoming request data
        Log::info('Request data: ', $request->all());

        // Validation rules
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Log the validated data
        Log::info('Validated data: ', $validatedData);
    
        // Create a new request
        try {
            $newRequest = RequestModel::create($validatedData);
            Log::info('Request created: ', $newRequest->toArray());

            return redirect()->route('home')
                ->with('success', 'Request sent successfully.');
        } catch (\Exception $e) {
            Log::error('Request creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to send request.');
        }
    }
}


        // dd($request->all()); // Add this line to dump the request data