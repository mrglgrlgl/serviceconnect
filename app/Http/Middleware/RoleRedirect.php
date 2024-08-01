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
        $currentRoute = $request->route()->getName();

        switch ($userRole) {
            case 1:
                if ($currentRoute !== 'authorizer.dashboard') {
                    return redirect()->route('authorizer.dashboard');
                }
                break;
            case 2:
                if ($currentRoute !== 'provider.dashboard') {
                    return redirect()->route('provider.dashboard');
                }
                break;
            case 3:
                if ($currentRoute !== 'dashboard') {
                    return redirect()->route('dashboard');
                }
                break;
            default:
                abort(403, 'Unauthorized action.');
        }

        return $next($request); // Allow the request to proceed
    }
}


