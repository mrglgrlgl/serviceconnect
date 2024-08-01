<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhilID;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Example with Auth user ID or replace with the appropriate identifier
        $philIDs = PhilID::where('provider_id', Auth::id())->get(); // Adjust the condition as necessary

        // Pass the data to the view
        return view('authorizer.dashboard', compact('philIDs'));
    }
}

