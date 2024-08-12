<?php

// app/Http/Middleware/AdminAuthMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin_user')->check()) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
