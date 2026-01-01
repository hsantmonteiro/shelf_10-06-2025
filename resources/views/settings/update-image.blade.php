@extends('layouts.app')
@section('title')
    Alterar/Adicionar imagem
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
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Alterar nome</h1>
    </header>
    <section class="main-body bg-neutral-200">

        <form class="user-form" action="{{ route('settings.update-name.post') }}" method="POST">
            @csrf
            <div class="label-input">
                <label for="name" class="fw-bold">Nome Completo</label>
                <input type="text" class="textbox @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="btn-footer margin-top-400">
                <a href="/home" class="btn btn--secondary btn--neutral">Cancelar</a>
                <button type="submit" class="btn btn--primary">
                    Salvar
                </button>
            </div>
        </form>
    </section>
@endsection
