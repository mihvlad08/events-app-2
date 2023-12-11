<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin2Middleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin2')->check()) {
            return $next($request);
        }

        return redirect()->route('userLoginGET')
            ->withErrors(['unauthorized' => 'Unauthorized access']); // Redirect to admin login page
    }
}
