@extends('layouts.app')
@section('title')
    Alterar senha
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="../settings">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Alterar senha</h1>
    </header>
    <section class="main-body bg-neutral-200">

        <form class="user-form" action="{{ route('settings.update-password.post') }}" method="POST">
            @csrf

            <div class="label-input">
                <label for="current_password" class="fw-bold">Senha Atual</label>
                <input type="password" class="textbox @error('current_password') is-invalid @enderror" id="current_password"
                    name="current_password" required />
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="label-input">
                <label for="new_password" class="fw-bold">Nova Senha</label>
                <input type="password" class="textbox @error('new_password') is-invalid @enderror" id="new_password"
                    name="new_password" required />
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="label-input">
                <label for="new_password_confirmation" class="fw-bold">Confirme a Nova Senha</label>
                <input type="password" class="textbox" id="new_password_confirmation" name="new_password_confirmation"
                    required />
            </div>

            <div class="btn-footer margin-top-400">
                <a href="/home" class="btn btn--secondary btn--neutral">Cancelar</a>
                <button type="submit" class="btn btn--primary">
                    Atualizar Senha
                </button>
            </div>
        </form>
    </section>
@endsection
