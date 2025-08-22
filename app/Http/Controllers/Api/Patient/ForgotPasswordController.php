<?php
namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (! $user || ! $user->hasRole('patient')) {
            return response()->json(['message' => 'Unauthorized or invalid role.'], 403);
        }

        $status = Password::broker('patients')->sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'message' => __($status),
            'success' => $status === Password::RESET_LINK_SENT,
        ]);
    }
}

