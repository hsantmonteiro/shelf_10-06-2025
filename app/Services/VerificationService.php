<?php

namespace App\Services;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class VerificationService
{
    public function generateAndSendVerificationCode(User $user)
    {
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        VerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($user->email)->send(new VerificationCodeMail($code));
    }
}