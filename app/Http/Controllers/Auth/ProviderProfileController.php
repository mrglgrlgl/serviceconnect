<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderDetail;
use App\Models\Certification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProviderProfileController extends Controller
{
    public function index()
    {
        return view('auth.verify.profile.profilecreate');
    }
    public function saveProfileCreate(Request $request)
    {
        // Use dd here to see the data
        // dd($request->all());
    
        $validatedData = $request->validate([
            
            'work_email' => 'nullable|email',
            'contact_number' => 'nullable|string',
            'serviceCategory' => 'required|string',
            'description' => 'required|string',
            'years_of_experience' => 'required|integer',
            'have_tools' => 'required|string',
            'availability_days' => 'required|array',
            'availability_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            // 'availability_start' => 'required|string',
            // 'availability_end' => 'required|string',

            
        ]);
    
        // dd('Validation passed', $validatedData);
    
        // $availabilityTime = $validatedData['availability_start'] . ' - ' . $validatedData['availability_end'];
    
        $providerDetail = ProviderDetail::updateOrCreate(
            ['provider_id' => Auth::id()],
            [
                'work_email' => $validatedData['work_email'],
                'contact_number' => $validatedData['contact_number'],
                'serviceCategory' => $validatedData['serviceCategory'], // Ensure this matches the form and DB column
                'description' => $validatedData['description'],
                'years_of_experience' => $validatedData['years_of_experience'],
                'have_tools' => $validatedData['have_tools'],
                'availability_days' => implode(',', $validatedData['availability_days']),
                // 'availability_time' => $availabilityTime,
            ]
        );
        // dd('Provider detail saved successfully', ['provider_id' => $providerDetail->id]);

        return redirect()->route('provider.dashboard')->with('success', 'Profile updated successfully!');
    }
    
    
    
    public function showCertificationsForm()
    {
        $certifications = Certification::where('provider_id', Auth::id())->get();

        return view('auth.verify.profile.certifications', compact('certifications'));

    }

    // Method to handle form submission
    public function saveCertifications(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'date_attained' => 'required|date',
            'expiry_date' => 'nullable|date|after:date_attained',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('certifications', 'public');
        }

        Certification::create([
            'provider_id' => Auth::id(),
            'name' => $request->input('name'),
            'issuing_organization' => $request->input('issuing_organization'),
            'date_attained' => $request->input('date_attained'),
            'expiry_date' => $request->input('expiry_date'),
            'description' => $request->input('description'),
            'file_path' => $filePath,
        ]);

        return redirect()->route('provider.dashboard')->with('success', 'Certification added successfully.');
    }
}
