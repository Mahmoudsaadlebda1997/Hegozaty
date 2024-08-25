<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'customer' role
        if (Auth::check() && Auth::user()->role === 'customer') {
            // Redirect to home page or another route
            return redirect('/')->with('error', 'ليس لديك امكانيه للدخول في لوحه التحكم.');
        }

        return $next($request);
    }
}
