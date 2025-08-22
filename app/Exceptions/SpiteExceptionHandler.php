<?php

namespace App\Exceptions;

class SpiteExceptionHandler
{
    /**
     * Create a new class instance.
     */
     public static array $handlers = [
        UnauthorizedException::class => 'handleUnauthorized',
    ];

    public function handleUnauthorized(UnauthorizedException $e, Request $request): Response
    {

            dd('here');
      
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'You do not have the required permissions.',
                'success' => false
            ], 403);
        }

        // Redirect for web
        return redirect('/home')->with('error', 'Access Denied.');
    }
}
