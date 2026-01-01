<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected function user()
    {
        return Auth::user();
    }

    public function edit()
    {
        $user = $this->user();
        return view('settings', compact('user'));
    }

    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ]+(?:\s[A-Za-zÀ-ÿ]+)+$/'],
        ], [
            'name.regex' => 'Insira seu nome completo.',
        ]);

        $this->user()->update(['name' => $validated['name']]);

        return redirect('settings')->with('success', 'Nome atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'A senha atual está incorreta.',
            'new_password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'new_password.confirmed' => 'A confirmação da senha não corresponde.',
        ]);

        $this->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect('settings')->with('success', 'Senha atualizada com sucesso!');
    }

    public function updatePicture(Request $request)
    {
        $user = $this->user();

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png ou jpg.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            
            $user->update([
                'photo_path' => $path,
                'photo_name' => $request->file('image')->getClientOriginalName(),
                'photo_size' => $request->file('image')->getSize(),
            ]);
        }

        if ($request->has('remove_cover') && $user->photo_path) {
            Storage::disk('public')->delete($user->photo_path);

            $user->update([
                'photo_name' => null,
                'photo_size' => null,
                'photo_path' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Foto de perfil atualizada!');
    }
}
