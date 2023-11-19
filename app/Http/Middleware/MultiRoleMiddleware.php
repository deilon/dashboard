<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MultiRoleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user has any of the specified roles
        foreach ($roles as $role) {
            if (Auth::user()->role ==$role) {
                return $next($request);
            }
        }

        // User does not have any of the specified roles
        // return redirect('/unauthorized'); // You can customize this redirection as needed
        return response()->json(['You do not have permission to access for this page.']);
    }
}
