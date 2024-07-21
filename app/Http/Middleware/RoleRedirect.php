<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Handle unauthenticated users
        }

        $userRole = Auth::user()->role;

        // Check and redirect based on the user's role
        switch ($userRole) {
            case 2:
                // Redirect to provider dashboard if user is a provider
                if (!$request->routeIs('provider.dashboard')) {
                    return redirect()->route('provider.dashboard');
                }
                break;

            case 1:
                // Redirect to authorizer dashboard if user is an authorizer
                if (!$request->routeIs('authorizer.dashboard')) {
                    return redirect()->route('authorizer.dashboard');
                }
                break;

            case 3:
                // Redirect to default dashboard if user is a normal user
                if (!$request->routeIs('dashboard')) {
                    return redirect()->route('dashboard');
                }
                break;

            default:
                // Redirect to default dashboard if role is not recognized
                return redirect()->route('dashboard');
        }

        // Proceed with the request if no redirection is needed
        return $next($request);
    }
}

