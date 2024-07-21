<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RedirectionController extends Controller
{
    public function providerDashboard()
    {
        // Logic for the provider dashboard
        return view('provider.dashboard');
    }

    public function authorizerDashboard()
    {
        // Logic for the authorizer dashboard
        return view('authorizer.dashboard');
    }

    public function defaultDashboard()
    {
        // Logic for the default dashboard
        return view('dashboard');
    }
}
