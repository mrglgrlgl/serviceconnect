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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'cell_no' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'max:255'],
            'birth_date_month' => ['integer', 'max:12'],
            'birth_date_day' => ['required', 'integer', 'max:31'],
            'birth_date_year' => ['required', 'integer', 'max:9999'],
        ]);

        $birth_date = $request->input('birth_date_year') . '-' . str_pad($request->input('birth_date_month'), 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->input('birth_date_day'), 2, '0', STR_PAD_LEFT);

        $userData = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'cell_no' => '63' . ltrim($request->cell_no, '0'), // Add '63' prefix and remove leading zero if present
            'password' => Hash::make($request->password),
            'gender' => $request->input('gender'),
            'birth_date' => $birth_date,
        ];

        // Check if the user's role is set in the session
        if ($request->session()->has('user_role')) {
            $userData['role'] = $request->session()->get('user_role');
            $request->session()->forget('user_role');
        } else {
            $userData['role'] = 3; // Default role if not set
        }

        // Create the user
        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to the address form after successful registration
        return redirect()->route('address.create', ['userId' => $user->id]);
    }

    public function registerAs(Request $request)
    {
        if ($request->has('role') && $request->input('role') === 'provider') {
            $request->session()->put('user_role', 2); // Role 2 for providers
            return redirect()->route('register');
        }
        return view('auth.registerAs');
    }
}
