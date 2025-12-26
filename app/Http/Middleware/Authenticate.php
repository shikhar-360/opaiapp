<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if (!empty(session('impersonation_stack', []))) {
            return null; // don't redirect to login while impersonating chain exists
        }

        if (! $request->expectsJson()) {
            if ($request->is('superadmin/*')) return route('superadmin.login');
            if ($request->is('admin/*')) return route('admin.login');
            return redirect()->route('customer.login');
        }

        return null;
        
        /*if (! $request->expectsJson()) {

            if ($request->is('superadmin/*')) {
                return route('superadmin.login');
            }

            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            return route('login');

        }*/
        // return $request->expectsJson() ? null : route('login');
    }
}
