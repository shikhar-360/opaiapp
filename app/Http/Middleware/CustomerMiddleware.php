<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        dd([
            'customer' => Auth::guard('customer')->check(),
            'admin' => Auth::guard('admin')->check(),
            'superadmin' => Auth::guard('superadmin')->check(),
            'session' => session()->all(),
        ]);

        if (!Auth::guard('customer')->check() || Auth::guard('customer')->user()->role !== 'customer') {
            return redirect()->route('login');
        }
        return $next($request);
    }*/

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('customer')->check()) {
            return $next($request);
        }

        // Allow exit route even if customer session ended but stack exists
        if (!empty(session('impersonation_stack', [])) && $request->routeIs('impersonation.exit')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
