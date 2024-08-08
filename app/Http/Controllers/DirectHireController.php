<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestImages;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DirectHireController extends Controller
{
    public function create($providerId)
    {
        $provider = User::findOrFail($providerId);
        $categories = Category::all();
        return view('layouts.directhiremodal', compact('provider', 'categories'));
    }

    public function store(Request $request)
    {
        ($request->all());

        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            // 'skill_tags' => 'required|string|max:255',
            'provider_gender' => 'nullable|in:male,female',
            'job_type' => 'required|in:project_based,hourly_rate',
            'price_type' => 'required|in:fixed,range',
            'max_price' => 'required|numeric|min:0',
            'min_price' => 'nullable|numeric|min:0',
            'estimated_duration' => 'required|integer|min:0',
            'attach_media1' => 'nullable|image|max:2048',
            'attach_media2' => 'nullable|image|max:2048',
            'attach_media3' => 'nullable|image|max:2048',
            'attach_media4' => 'nullable|image|max:2048',
            'agreed_to_terms' => 'accepted',
        ]);

        $serviceRequest = new ServiceRequest();
        $serviceRequest->category = $validatedData['category'];
        $serviceRequest->title = $validatedData['title'];
        $serviceRequest->description = $validatedData['description'];
        $serviceRequest->location = $validatedData['location'];
        $serviceRequest->start_date = $validatedData['start_date'];
        $serviceRequest->end_date = $validatedData['end_date'];
        $serviceRequest->start_time = $validatedData['start_time'];
        $serviceRequest->end_time = $validatedData['end_time'];
        // $serviceRequest->skill_tags = $validatedData['skill_tags'];
        $serviceRequest->provider_gender = $validatedData['provider_gender'];
        $serviceRequest->job_type = $validatedData['job_type'];
        $serviceRequest->min_price = $validatedData['min_price'];
        $serviceRequest->max_price = $validatedData['max_price'];
        $serviceRequest->estimated_duration = $validatedData['estimated_duration'];
        $serviceRequest->status = 'open';
        $serviceRequest->user_id = Auth::id();
        $serviceRequest->provider_id = $request->provider_id;
        $serviceRequest->is_direct_hire = true;
        $serviceRequest->agreed_to_terms = $validatedData['agreed_to_terms'];

        $serviceRequest->save();

        $mediaFields = ['attach_media1', 'attach_media2', 'attach_media3', 'attach_media4'];
        foreach ($mediaFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('service_requests/documents', 'public');
                ServiceRequestImages::create([
                    'service_request_id' => $serviceRequest->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Direct hire request sent successfully!');
    }
}
