<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display the address form.
     *
     * @param int $userId
     * @return \Illuminate\View\View
     */
    public function create($userId)
    {
        return view('auth.address', ['userId' => $userId]);
    }

    /**
     * Handle the address form submission and save the address data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
        ]);

        $userId = $request->input('userId');
        $user = User::findOrFail($userId);
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('home');
    }
}
