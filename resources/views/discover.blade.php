@extends('layouts.app')
@section('discover-item')
    sidebar-item--active
@endsection
@section('content')
    <header class="ui-main__header gap-100 jc-space-between">
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">
            Explorar
        </h1>
        <div class="search-container">
            <form id="library-search-form" action="{{ route('library.search') }}" method="GET">
                <label class="textbox textbox--search">
                    <input type="text" id="library-search" name="query" placeholder="Pesquisar bibliotecas..."
                        autocomplete="off" class="textbox" value="{{ request('query') }}" required>
                    <button type="submit" class="btn btn--primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </button>
                    <div id="search-suggestions" class="search-suggestions"></div>
                </label>
            </form>
        </div>
    </header>
    <section class="main-body">
        @if (request()->has('query'))
            <section class="library-section">
                @forelse($todasBibliotecas as $library)
                    @php
                        $isMember = auth()->user()->memberLibraries->contains('id_biblioteca', $library->id_biblioteca);
                        $isManager = auth()
                            ->user()
                            ->managedLibraries->contains('id_biblioteca', $library->id_biblioteca);
                    @endphp
                    <a href="{{ route('library.rules', $library->nm_handle) }}" class="library-block">
                        <div class="flex gap-400 margin-bottom-200 ai-center">
                            <img src="../assets/img/library-illustration.png" alt="Foto de perfil da biblioteca"
                                class="library-pfp" />
                            <div>
                                <h3 class="fc-neutral-900 fs-300 fw-bold lines-max-2">
                                    {{ $library->nm_biblioteca }}
                                </h3>
                                <span class="fc-neutral-400 fw-regular">
                                    &commat;{{ $library->nm_handle }}
                                </span>
                            </div>
                        </div>
                        <p class="fc-neutral-900 fs-200 lines-max-3 height-lines-max">
                            {{ $library->ds_descricao }}
                        </p>
                        <div class="btn-footer">
                            @if ($isManager)
                                <object>
                                    <a href="{{ route('library.edit', $library) }}"
                                        class="btn btn--secondary btn--neutral btn--small">
                                        Editar
                                    </a>
                                </object>
                                <form method="POST" action="{{ route('library.delete', $library) }}"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn--primary btn--alert btn--small"
                                        onclick="return confirm('Tem certeza que deseja excluir esta biblioteca?')">
                                        Excluir
                                    </button>
                                </form>
                            @elseif ($isMember)
                                <form action="{{ route('library.leave', $library->id_biblioteca) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button class="btn btn--secondary btn--neutral btn--small">
                                        Membro
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('library.join', $library->id_biblioteca) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button class="btn btn--primary btn--small">
                                        Entrar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </a>
            </section>
        @empty
            <p class="no-results">Nenhuma biblioteca encontrada.</p>
        @endforelse
    @else
        <section class="library-section">
            @forelse($todasBibliotecas as $library)
                @php
                    $isMember = auth()->user()->memberLibraries->contains('id_biblioteca', $library->id_biblioteca);
                    $isManager = auth()->user()->managedLibraries->contains('id_biblioteca', $library->id_biblioteca);
                @endphp

                <a href="{{ route('library.books', $library->nm_handle) }}" class="library-block">
                    <div class="flex gap-400 margin-bottom-200 ai-center">
                        <img src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                        alt="Foto de perfil da biblioteca" class="library-pfp" />
                        <div>
                            <h3 class="fc-neutral-900 fs-300 fw-bold lines-max-2">
                                {{ $library->nm_biblioteca }}
                            </h3>
                            <span class="fc-neutral-400 fw-regular">
                                &commat;{{ $library->nm_handle }}
                            </span>
                        </div>
                    </div>
                    <p class="fc-neutral-900 fs-200 lines-max-3 height-lines-max">
                        {{ $library->ds_descricao }}
                    </p>
                    <div class="btn-footer">
                        @if ($isManager)
                            <object>
                                <a href="{{ route('library.edit', $library) }}"
                                    class="btn btn--secondary btn--neutral btn--small">
                                    Editar
                                </a>
                            </object>
                            <form method="POST" action="{{ route('library.delete', $library) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn--primary btn--alert btn--small"
                                    onclick="return confirm('Tem certeza que deseja excluir esta biblioteca?')">
                                    Excluir
                                </button>
                            </form>
                        @elseif ($isMember)
                            <form action="{{ route('library.leave', $library->id_biblioteca) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn--secondary btn--neutral btn--small">
                                    Membro
                                </button>
                            </form>
                        @else
                            <form action="{{ route('library.join', $library->id_biblioteca) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn--primary btn--small">
                                    Entrar
                                </button>
                            </form>
                        @endif
                    </div>
                </a>
            @empty
        </section>
        <p class="no-results">Nenhuma biblioteca encontrada.</p>
        @endforelse
        @endif
    </section>
@endsection
