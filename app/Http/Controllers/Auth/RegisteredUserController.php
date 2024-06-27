<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'max:255'],
            'birth_date_month' => ['integer', 'max:12'],
            'birth_date_day' => ['required', 'integer', 'max:31'],
            'birth_date_year' => ['required', 'integer', 'max:9999'],
        ]);

        $birth_date = $request->input('birth_date_year') . '-' . str_pad($request->input('birth_date_month'), 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->input('birth_date_day'), 2, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name . ' '. $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->input('gender'),
            'birth_date' => $birth_date,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('address.create', ['userId' => $user->id]);
    }

    /**
     * Display the address form view.
     *
     * @param int $userId
     * @return \Illuminate\View\View
     */
    public function showAddressForm($userId)
    {
        return view('auth.address', ['userId' => $userId]);
    }

    /**
     * Handle the address form submission and save the address data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
        ]);

        $userId = $request->input('userId');
        $user = User::findOrFail($userId);
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('dashboard');
    }
}
