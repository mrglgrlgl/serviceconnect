<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        \Log::info('Attempting login with:', $credentials);
        \Log::info('Using guard:', ['guard' => Auth::guard('admin_user')->getName()]);
        \Log::info('Guard Provider:', ['provider' => Auth::guard('admin_user')->getProvider()]);
        
        if (Auth::guard('admin_user')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin_user')->logout();
        return redirect()->route('admin.login');
    }
}
