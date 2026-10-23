<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login')->with('error', 'Please login to access admin area.');
        }

        // Get the authenticated admin user
        $admin = Auth::guard('admin')->user();

        // Optional: Check for admin role or privilege
        if (!isset($admin->is_admin) || $admin->is_admin != 1) {
            Auth::guard('admin')->logout(); // Logout from admin guard
            return redirect('/admin/login')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);

    }
}
