<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $this->validate($request, [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     if (method_exists($this, 'hasTooManyLoginAttempts') &&
    //         $this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
    //         $request->session()->regenerate();

    //         $this->clearLoginAttempts($request);

    //         $loggedInUserRole = $request->user()->role;

    //         // Redirect based on role
    //         if ($loggedInUserRole == 1) {
    //             return redirect()->intended(route('authorizer.dashboard'));
    //         } elseif ($loggedInUserRole == 2) {
    //             return redirect()->intended(route('provider.dashboard'));
    //         } elseif ($loggedInUserRole == 3) {
    //             return redirect()->intended(route('dashboard'));
    //         }

    //         return redirect()->intended(route('home'));
    //     }

    //     $this->incrementLoginAttempts($request);

    //     throw ValidationException::withMessages([
    //         'email' => [trans('auth.failed')],
    //     ]);
    // }
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            switch ($userRole) {
                case 1:
                    return redirect()->intended(route('authorizer.dashboard'));
                case 2:
                    return redirect()->intended(route('provider.dashboard'));
                case 3:
                    return redirect()->intended(route('dashboard'));
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Role not recognized.']);
            }
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        // Implement your rate limiting logic here
    }

    protected function incrementLoginAttempts(Request $request)
    {
        // Implement your rate limiting logic here
    }

    protected function clearLoginAttempts(Request $request)
    {
        // Implement your rate limiting logic here
    }

    protected function sendLockoutResponse(Request $request)
    {
        // Implement your lockout response logic here
    }

    protected function fireLockoutEvent(Request $request)
    {
        // Implement your lockout event logic here
    }
}
