<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyUserController extends Controller
{
    public function showLoginForm()
    {
        // Ensure this points to the correct path in views
        return view('agencyuser.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('agency_users')->attempt($credentials)) {
            return redirect()->route('agency.home');  // Redirect to agency.home
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('agency_users')->logout();
        return redirect()->route('agency.login');
    }
}
