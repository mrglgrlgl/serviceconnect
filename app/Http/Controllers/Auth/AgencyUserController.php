<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyUserController extends Controller
{
    public function showLoginForm()
    {
        return view('agency.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('agency_user')->attempt($credentials)) {
            return redirect()->route('agency.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('agency_user')->logout();
        return redirect()->route('agency.login');
    }
}
