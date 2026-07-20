<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!$request->user()->hasRole($roles)) {
            // Redirect standard 'user' role away from admin pages to a client/rental info page
            if ($request->user()->isUser() && $request->is('admin*')) {
                return redirect()->route('rental.info');
            }

            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
