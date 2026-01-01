@extends('layouts.app')
@section('title')
    Emprestar livro
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <a
            class="icon-btn"
            href="../home"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                width="28"
                height="28"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
            >
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Emprestar {{ $livro->nm_livro }}</h1>
    </header>
    <div class="main-body bg-neutral-200">
        <form
            class="user-form"
            action="{{ route('books.lend', $livro->id_livro) }}"
            method="POST"
        >
            @csrf
            <div class="label-input">
                <label
                    class="fw-bold"
                    for="id_usuario"
                >Usuário</label>
                <select
                    class="textbox textbox--dropdown"
                    name="id_usuario"
                    id="id_usuario"
                    required
                >
                    @if ($usuarios->isEmpty())
                        <option value="">Nenhum usuário disponível</option>
                    @else
                        <option value="">Selecione um usuário...</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="btn-footer margin-top-400"><button
                    class="btn btn--primary"
                    type="submit"
                >Registrar Empréstimo</button></div>
        </form>
    </div>
@endsection
