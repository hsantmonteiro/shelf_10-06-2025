<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use App\Services\VerificationService;
use Illuminate\Support\Facades\Auth; // Added this import

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ]+(?:\s[A-Za-zÀ-ÿ]+)+$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!checkdnsrr(explode('@', $value)[1])) {
                        $fail('Utilize um e-mail válido.');
                    }
                }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.regex' => 'Insira seu nome completo.',
            'email.required' => 'Este e-mail já está em uso.'
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
        ]);

        app(VerificationService::class)->generateAndSendVerificationCode($user);

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('verification.notice');
    }
}