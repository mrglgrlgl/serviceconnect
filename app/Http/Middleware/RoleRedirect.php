<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        switch ($userRole) {
            case 1:
                return redirect()->route('authorizer.dashboard');
            case 2:
                return redirect()->route('provider.dashboard');
            case 3:
                return redirect()->route('dashboard');
            default:
                abort(403, 'Unauthorized action.');
        }
    }
}

