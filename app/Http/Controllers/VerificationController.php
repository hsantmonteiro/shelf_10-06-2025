<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use App\Services\VerificationService;

class VerificationController extends Controller
{
    // app/Http/Controllers/VerificationController.php

    public function notice()
    {
        // If user is authenticated but not verified
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }

        // If user is not logged in, redirect to login
        Auth::logout();
        return redirect()->route('login');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        $verificationCode = VerificationCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verificationCode) {
            return back()->withErrors(['code' => 'Código inválido ou expirado.']);
        }

        // Mark email as verified
        $user->email_verified_at = now();
        $user->save();

        // Delete the used code
        $verificationCode->delete();

        return redirect()->route('home')->with('verified', true);
    }

    // app/Http/Controllers/VerificationController.php
    public function resend()
    {
        $user = Auth::user();
        VerificationCode::where('user_id', $user->id)->delete();
        app(VerificationService::class)->generateAndSendVerificationCode($user);
        return back()->with('resent', 'Um novo código foi enviado ao seu e-mail.');
    }

    public function cancel(Request $request)
    {
        // $request->user()->delete(); // Optional: delete the unverified user
        Auth::logout();
        
        return redirect()->route('register');
    }
}