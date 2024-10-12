<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsaJob;

class PsaJobController extends Controller
{
    public function index()
    {
        $psaJobs = PsaJob::all();
        return view('admin.services', compact('psaJobs')); // Pointing to services.blade.php
    }
    
    // Store a new job title
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Job_Title' => 'required|string|max:255',
        ]);

        PsaJob::create([
            'Job_Title' => $validated['Job_Title'],
        ]);

        return redirect()->route('admin.psajobs.index')->with('success', 'Job title added successfully!');
    }

    // Edit an existing job title
    public function edit($id)
    {
        $psaJob = PsaJob::findOrFail($id);
        return response()->json($psaJob);
    }

    // Update an existing job title
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Job_Title' => 'required|string|max:255',
        ]);

        $psaJob = PsaJob::findOrFail($id);
        $psaJob->update([
            'Job_Title' => $validated['Job_Title'],
        ]);

        return redirect()->route('admin.psajobs.index')->with('success', 'Job title updated successfully!');
    }

    // Delete a job title
    public function destroy($id)
    {
        $psaJob = PsaJob::findOrFail($id);
        $psaJob->delete();

        return redirect()->route('admin.psajobs.index')->with('success', 'Job title deleted successfully!');
    }
}
