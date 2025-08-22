<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function dashboardRedirect(Request $request)
    {
        $user = $request->user();
        $role = $user->getRoleNames()->first(); 
        $redirect = config("roles.$role");

        return $redirect
            ? redirect()->route($redirect)
            : redirect('/')->with('error', 'Unauthorized role.');
    }
}
