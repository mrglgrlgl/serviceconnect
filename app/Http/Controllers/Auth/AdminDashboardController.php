<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Import the correct Controller class
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // You can return a view or any other logic here
        return view('admin.dashboard');
    }
}
