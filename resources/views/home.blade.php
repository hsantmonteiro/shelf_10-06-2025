@extends('layouts.app')
@section('home-item')
    sidebar-item--active
@endsection
@section('content')
    <header class="ui-main__header gap-100 jc-space-between">
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">
            Olá, {{ explode(' ', auth()->user()->name)[0] }}
        </h1>
        <div class="flex gap-200 ai-center desktop-only">
            <button class="btn btn--primary btn--small open-modal" data-open="create-library">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
                <span>Criar biblioteca</span>
            </button>
            <a href="discover" class="btn btn--secondary btn--small">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                    <path d="M21 21l-6 -6"></path>
                </svg>
                <span>Buscar bibliotecas</span>
            </a>
        </div>
    </header>
    <section class="main-body">
        <div class="mobile-only">
            <button class="btn btn--primary btn--small open-modal" data-open="create-library">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
                <span>Criar biblioteca</span>
            </button>
            <a href="discover" class="btn btn--secondary btn--small">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                    <path d="M21 21l-6 -6"></path>
                </svg>
                <span>Buscar bibliotecas</span>
            </a>
        </div>
        <details open class="margin-bottom-400">
            <summary class="summary-title">
                <img class="summary-title__img" src="../assets/svg/chevron-down.svg" alt="">
                <h2 class="fs-heading-3 fw-bold">Suas bibliotecas</h2>
            </summary>

            <section class="library-section">
                @forelse ($bibliotecas as $library)
                    <a href="{{ route('library.rules', $library->nm_handle) }}" class="library-block">
                        <div class="flex gap-400 ai-center margin-bottom-200">
                            <img src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                                alt="Foto de perfil da biblioteca" class="library-pfp" />
                            <div>
                                <h3 class="fc-neutral-900 fs-300 fw-bold lines-max-2 margin-bottom-100">
                                    {{ $library->nm_biblioteca }}
                                </h3>
                                <span class="fc-neutral-400 lines-max-1 fw-regular">
                                    &commat;{{ $library->nm_handle }}
                                </span>
                            </div>
                        </div>
                        <p class="fc-neutral-900 fs-200 lines-max-3 height-lines-max">
                            {{ $library->ds_descricao }}
                        </p>
                        <div class="btn-footer">
                            <object>
                                <a href="{{ route('library.edit', $library) }}"
                                    class="btn btn--secondary btn--neutral btn--small">
                                    Editar
                                </a>
                            </object>
                            <form method="POST" action="{{ route('library.delete', $library) }}">
                                @csrf
                                <button type="submit" class="btn btn--primary btn--alert btn--small"
                                    onclick="return confirm('Tem certeza que deseja excluir esta biblioteca?')">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </a>
                @empty
            </section>
            <div class="flex flex-column padding-400 ai-center margin-x-auto">
                <p class="fs-300 fc-neutral-400 text-center margin-bottom-400">Você não tem bibliotecas criadas.</p>
                <button class="btn btn--primary btn--small open-modal" data-open="create-library">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span>Criar biblioteca</span>
                </button>
            </div>
            @endforelse
        </details>

        <details open>
            <summary class="summary-title">
                <img class="summary-title__img" src="../assets/svg/chevron-down.svg" alt="">
                <h2 class="fs-heading-3 fw-bold">Bibliotecas que faz parte</h2>
            </summary>

            @forelse(auth()->user()->memberLibraries as $library)
                <section class="library-section">
                    @php
                        $isNotManager = !auth()
                            ->user()
                            ->managedLibraries->contains('id_biblioteca', $library->id_biblioteca);
                    @endphp

                    @if ($isNotManager)
                        {{-- <div class="library-block">
                            <div class="flex gap-400 ai-center margin-bottom-200">
                                <img
                                    src="../assets/img/bookshelf.png"
                                    alt="Foto de perfil da biblioteca"
                                    class="library-pfp"
                                />
                                <div>
                                    <h3 class="fs-300 fw-bold lines-max-2 margin-bottom-100">
                                        {{ $library->nm_biblioteca }}
                                    </h3>
                                    <span class="fc-neutral-400 lines-max-1 fw-regular">
                                        &commat;{{ $library->nm_handle }}
                                    </span>
                                </div>
                            </div>
                            <p class="fs-200 lines-max-3 height-lines-max">
                                {{ $library->ds_descricao }}
                            </p>
                            <div class="flex jc-space-between">
                                <a
                                    href="{{ route('library.books', $library->nm_handle) }}"
                                    class="btn btn--secondary btn--small"
                                >Ver livros</a>
                                <form
                                    action="{{ route('library.leave', $library->id_biblioteca) }}"
                                    method="POST"
                                    style="display:inline;"
                                >
                                    @csrf
                                    <button class="btn btn--secondary btn--neutral btn--small">
                                        Membro
                                    </button>
                                </form>
                            </div>
                        </div> --}}
                        <a href="{{ route('library.rules', $library->nm_handle) }}" class="library-block">
                            <div class="flex gap-400 ai-center margin-bottom-200">
                                <img src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                                    alt="Foto de perfil da biblioteca" class="library-pfp" />
                                <div>
                                    <h3 class="fc-neutral-900 fs-300 fw-bold lines-max-2 margin-bottom-100">
                                        {{ $library->nm_biblioteca }}
                                    </h3>
                                    <span class="fc-neutral-400 lines-max-1 fw-regular">
                                        &commat;{{ $library->nm_handle }}
                                    </span>
                                </div>
                            </div>
                            <p class="fc-neutral-900 fs-200 lines-max-3 height-lines-max">
                                {{ $library->ds_descricao }}
                            </p>
                            <div class="btn-footer">
                                <form action="{{ route('library.leave', $library->id_biblioteca) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button class="btn btn--secondary btn--neutral btn--small">
                                        Membro
                                    </button>
                                </form>
                            </div>
                        </a>
                    @endif
                </section>
            @empty
                <div class="flex flex-column padding-400 ai-center margin-x-auto">
                    <p class="fs-300 fc-neutral-400 text-center margin-bottom-400">Você não faz parte de nenhuma
                        biblioteca.</p>
                    <a href="/discover" class="btn btn--secondary btn--small w-fit-content">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                        <span>Buscar bibliotecas</span>
                    </a>
                </div>
            @endforelse
        </details>
    </section>
    <div class="modal-wrapper" data-modal="create-library">
        <div class="modal">
            <header class="modal__header">
                <h1 class="fs-heading-3 fw-bold">Criar biblioteca</h1>
                <button class="icon-btn close-modal" data-close="create-library"><img
                        src="{{ asset('assets/svg/close.svg') }}"></button>
            </header>
            <form action="/create-library" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal__body">
                    <div class="flex even-columns">
                        <div class="flex-column">
                            <h2 class="fs-heading-4 fw-bold heading-separation">Informações Básicas</h2>
                            <div class="label-input">
                                <label class="fw-bold" for="file-upload">Foto de perfil</label>
                                <div class="margin-bottom-300">
                                    <div id="current-image">
                                        <img class="library-pfp library-pfp--large outline-neutral-400"
                                            src="{{ !empty($book->photo_path) ? asset('storage/' . $book->photo_path) : asset('assets/svg/library-frame.svg') }}"
                                            alt="Capa atual">
                                    </div>
                                    <div id="image-preview-container" style="display: none">
                                        <img class="library-pfp library-pfp--large" id="image-preview" src=""
                                            alt="Preview">
                                    </div>
                                </div>
                                <div class="btn-footer btn-footer--start">
                                    <div class="flex gap-100 ai-center">
                                        <label for="file-upload" class="btn btn--secondary btn--small w-fit-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M15 8h.01" />
                                                <path
                                                    d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                            </svg>
                                            <span class="file-upload">Inserir imagem</span>
                                            <input type="file" name="image" id="file-upload" class="display-none"
                                                accept="image/*">
                                        </label>
                                        <button type="button" id="remove-image" class="icon-btn"
                                            style="display: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                            <span class="sr-only">Remover</span>
                                        </button>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback" style="margin-top: .5rem; display: block;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="label-input">
                                <label for="nm_biblioteca" class="fw-bold">Nome de exibição</label>
                                <input class="textbox" type="text" placeholder="Biblioteca de Alexandria"
                                    name="nm_biblioteca" value="{{ old('nm_biblioteca') }}" id="biblioteca" required />
                                @error('nm_biblioteca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="handle" class="fw-bold"> Nome identificador</label>
                                <label class="textbox textbox--group">
                                    <div class="textbox__icon">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M16 20.064A9 9 0 1 1 21 12v1.5a2.5 2.5 0 0 1-5 0V8m0 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <input class="textbox border-none" type="text" placeholder="alexandria_biblioteca"
                                        name="nm_handle" value="{{ old('nm_handle') }}" id="handle" required />
                                </label>
                                @error('nm_handle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="description" class="fw-bold"> Descrição</label>
                                <input class="textbox lines-max-3" type="text" name="ds_descricao"
                                    value="{{ old('ds_descricao') }}" id="description" placeholder="Descrição" />
                                @error('ds_descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex-column">
                            <h2 class="fs-heading-4 fw-bold heading-separation">Configurações</h2>
                            <div class="label-input">
                                <label for="fine" class="fw-bold"> Valor da multa </label>
                                <label class="textbox textbox--group  textbox--300">
                                    <span class="textbox__preffix">R$</span>
                                    <input class="textbox" type="number" name="vl_multa" step="0.01" min="0"
                                        value="{{ old('vl_multa') }}" id="fine" placeholder="0,00" required />
                                </label>
                                @error('vl_multa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="returndays" class="fw-bold"> Dias para devolução </label>
                                <input class="textbox textbox--200" type="number" name="qt_dias_devolucao"
                                    value="{{ old('qt_dias_devolucao') }}" id="return-days" placeholder="Ex.: 7"
                                    min="1" required />
                                @error('qt_dias_devolucao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check margin-bottom-400">
                                <input class="checkbox form-check-input" type="checkbox" name="fl_dias_uteis"
                                    id="workingdays">
                                <label class="fw-bold form-check-label" for="workingdays"> Contar apenas dias úteis
                                </label>
                            </div>
                            <div class="label-input">
                                <label for="lendlimit" class="fw-bold"> Limite de empréstimos por pessoa </label>
                                <input class="textbox textbox--200" type="number" name="qt_limite_emprestimos"
                                    value="{{ old('qt_limite_emprestimos') }}" placeholder="Ex.: 1" min="1"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="modal__footer">
                    <button type="reset" class="btn btn--secondary btn--neutral btn--small">Limpar</button>
                    <button type="submit" class="btn btn--primary btn--small">Salvar</button>
                </footer>
            </form>
        </div>
    </div>
@endsection
