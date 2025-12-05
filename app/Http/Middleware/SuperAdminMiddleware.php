<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!auth()->check() || auth()->user()->role !== 'superadmin') {
        if (!Auth::guard('superadmin')->check() || Auth::guard('superadmin')->user()->role !== 'superadmin') {
            // abort(403, 'Unauthorized superadmin');
            return redirect()->route('superadmin.login');
        }

        return $next($request);

    }
}
