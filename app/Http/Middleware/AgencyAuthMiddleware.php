<?php

// app/Http/Middleware/AgencyAuthMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('agency_users')->check()) {
            return $next($request);
        }

        return redirect()->route('agency.login');
    }
}
