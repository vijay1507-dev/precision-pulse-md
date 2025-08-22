<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
        {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $next($request); 
            }

            if (auth()->check()) {
                $user = auth()->user();

                if ($user->hasRole('admin') && !$request->is('admin/dashboard')) {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->hasRole('doctor') && !$request->is('/dashboard')) {
                    return redirect()->route('dashboard');
                }

            }

            return $next($request);
        }
}
