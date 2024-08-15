<?php
namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = Agency::all();
        return view('admin.agencies', compact('agencies'));
    }

    public function create()
    {
        return view('admin.agencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agencies',
            // Add other validation rules as needed
        ]);

        Agency::create($request->all());

        return redirect()->route('agencies.index')->with('success', 'Agency created successfully.');
    }

    public function show(Agency $agency)
    {
        return view('admin.agencies.agency-detail', compact('agency'));
    }

    public function edit(Agency $agency)
    {
        return view('admin.agencies.edit', compact('agency'));
    }

    public function update(Request $request, Agency $agency)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:agencies,email,' . $agency->id,
            // Add other validation rules as needed
        ]);

        $agency->update($request->all());

        return redirect()->route('agencies.index')->with('success', 'Agency updated successfully.');
    }

    public function destroy(Agency $agency)
    {
        $agency->delete();

        return redirect()->route('agencies.index')->with('success', 'Agency deleted successfully.');
    }
}
