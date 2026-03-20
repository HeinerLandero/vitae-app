<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Verify the user's email address.
     */
    public function verify(Request $request, $id)
    {
        $user = Usuario::findOrFail($id);

        // Mark the email as verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Redirect to verification success page
        return view('verification-success');
    }

    /**
     * Resend the verification email.
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'El correo ya ha sido verificado.'], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email de verificación reenviado.']);
    }
}
