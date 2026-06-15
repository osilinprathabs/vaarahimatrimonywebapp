<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerApproved
{
    /**
     * Routes that pending (status=0) customers ARE allowed to access.
     * Everything else is blocked until admin approves.
     */
    protected array $allowedRoutes = [
        'dashboard',
        'logout',
        'register.details',        // complete profile after sign-up
        'register.details.store',  // submit the profile form
        'profile.photo.upload',    // profile photo on dashboard
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only apply to logged-in, non-admin customers who are pending
        if (
            $user &&
            $user->role !== 'admin' &&
            $user->role !== 'mediator' &&
            (int) $user->status === 0
        ) {
            $routeName = $request->route()?->getName();

            // Allow the dashboard and logout through
            if (!in_array($routeName, $this->allowedRoutes, true)) {
                return redirect()->route('dashboard')
                    ->with('pending_locked', true);
            }
        }

        return $next($request);
    }
}
