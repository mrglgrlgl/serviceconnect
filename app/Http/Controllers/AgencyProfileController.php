<?php
namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Agency; // Import the Agency model
use Illuminate\Http\Request;

class AgencyProfileController extends Controller
{
    public function show(Agency $agency)
    {
        return view('agency.show', compact('agency'));
    }
}


