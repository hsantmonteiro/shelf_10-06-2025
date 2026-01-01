@extends('layouts.app')
@section('library')
    aaa
@endsection
@section('title')
    {{ $book->nm_livro }}
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="{{ url()->previous() }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Detalhes do livro</h1>
    </header>
    <section class="main-body">
        {{-- <div class="user-form user-form--max"> --}}
        <div class="book-details-wrapper">
            <img src="{{ !empty($book->photo_path) ? asset('storage/' . $book->photo_path) : asset('assets/svg/book-frame.svg') }}"
                alt="Capa de {{ $book->nm_livro }}" class="book-cover book-cover--large">
            <div class="flex flex-column book-details-main">
                <header class="heading-separation">
                    <h2 class="fs-heading-3 fw-bold margin-bottom-100">
                        {{ $book->nm_livro }}
                    </h2>
                    <span class="fc-neutral-400">
                        Autor:
                        <a href="{{ route('library.books', $library->nm_handle) }}?search={{ $book->autor->nm_autor }}"
                            class="hypertext margin-bottom-300">{{ $book->autor->nm_autor }}</a>
                        &bullet;
                        Editora:
                        <a href="{{ route('library.books', $library->nm_handle) }}?search={{ $book->editora->nm_editora }}"
                            class="hypertext margin-bottom-300">{{ $book->editora->nm_editora }}</a>
                    </span>
                </header>
                @if ($book->ds_sinopse != null)
                    <div class="heading-separation">
                        <p class="sinopsis-text fc-neutral-400 fw-regular">
                            {{ $book->ds_sinopse }}
                        </p>
                    </div>
                @endif
                <section class="info-carousel">
                    <article>
                        <h3 class="fw-regular">Cutter</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M5 9l14 0"></path>
                            <path d="M5 15l14 0"></path>
                            <path d="M11 4l-4 16"></path>
                            <path d="M17 4l-4 16"></path>
                        </svg>
                        <span class="fw-bold">{{ $book->ds_cutter }}</span>
                    </article>
                    <article>
                        <h3 class="fw-regular">CDD</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M5 9l14 0"></path>
                            <path d="M5 15l14 0"></path>
                            <path d="M11 4l-4 16"></path>
                            <path d="M17 4l-4 16"></path>
                        </svg>
                        <span class="fw-bold">{{ $book->ds_cdd }}</span>
                    </article>
                    <article>
                        <h3 class="fw-regular">ISBN-13</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 12h10"></path>
                        </svg>
                        <span class="fw-bold">{{ $book->ds_isbn }}</span>
                    </article>
                    <article>
                        <h3 class="fw-regular">Ano de publicação</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                            </path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M7 14h.013"></path>
                            <path d="M10.01 14h.005"></path>
                            <path d="M13.01 14h.005"></path>
                            <path d="M16.015 14h.005"></path>
                            <path d="M13.015 17h.005"></path>
                            <path d="M7.01 17h.005"></path>
                            <path d="M10.01 17h.005"></path>
                        </svg>
                        <span class="fw-bold">{{ $book->nr_anoPublicacao }}</span>
                    </article>
                    <article>
                        <h3 class="fw-regular">Data de registro</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                            </path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M7 14h.013"></path>
                            <path d="M10.01 14h.005"></path>
                            <path d="M13.01 14h.005"></path>
                            <path d="M16.015 14h.005"></path>
                            <path d="M13.015 17h.005"></path>
                            <path d="M7.01 17h.005"></path>
                            <path d="M10.01 17h.005"></path>
                        </svg>
                        <span class="fw-bold">{{ \Carbon\Carbon::parse($book->dt_registro)->format('d/m/Y') }}
                        </span>
                    </article>
                    @if ($book->localPublicacao != null)
                        <article>
                            <h3 class="fw-regular">Local de publicação</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                </path>
                            </svg>
                            <span class="fw-bold">{{ $book->localPublicacao->nm_localPublicacao }}</span>
                        </article>
                    @endif
                </section>
                @if ($book->ds_observacao != null)
                    <h3 class="fw-bold fs-heading-4 margin-bottom-200">Observações</h3>
                    <p class="sinopsis-text fc-neutral-400 fw-regular">
                        {{ $book->ds_observacao }}
                    </p>
                @endif
            </div>
            <aside class="book-aside">
                @if (!empty($book->nr_exemplar) && $book->nr_exemplar >= 1)
                    <p class="fw-bold margin-bottom-400 fc-success">
                        {{ $book->nr_exemplar }} exemplares disponíveis.
                    </p>
                @else
                    <p class="fw-bold margin-bottom-400 invalid-feedback">
                        Nenhum exemplar disponível.
                    </p>
                @endif

                {{-- <h3 class="fw-regular fc-neutral-400 fs-200 margin-bottom-100">Gêneros:</h3> --}}
                <ul class="flex flex-wrap gap-100 ai-center margin-bottom-400">
                    <span class="fw-regular fc-neutral-400 fs-200">Gêneros:</span>
                    @foreach ($book->assuntos as $assunto)
                        <li class="genre-tag">
                            <a
                                href="{{ route('library.books', $library->nm_handle) }}?search={{ $assunto->nm_assunto }}">{{ $assunto->nm_assunto }}</a>
                        </li>
                    @endforeach
                </ul>
                @if ($book->serieColecao != null)
                    <span class="fw-regular fc-neutral-400 fs-200 margin-bottom-400">Coleção: <a
                            href="{{ route('library.books', $library->nm_handle) }}?search={{ $book->serieColecao->nm_seriecolecao }}"
                            class="hypertext margin-bottom-300">{{ $book->serieColecao->nm_seriecolecao }}</a></span>
                @endif
                <span class="fw-regular fc-neutral-400 fs-200 margin-bottom-400">Idioma: <a
                        href="{{ route('library.books', $library->nm_handle) }}?search={{ $book->idioma->nm_idioma }}"
                        class="hypertext margin-bottom-300">{{ $book->idioma->nm_idioma }}</a></span>
                @if ($book->nr_volume != null)
                    <span class="fw-regular fc-neutral-400 fs-200 margin-bottom-200">Volume
                        {{ $book->nr_volume }} @if ($book->nr_edicao != null)
                            &bullet; {{ $book->nr_edicao }}ª edição
                        @endif
                    </span>
                @endif

                {{-- In book-details.blade.php --}}
                {{-- Add this section where you want the form to appear --}}

                @if ($isManager)
                    <div class="flex gap-200 ai-center margin-top-400 width-full">
                        @if ($book->fl_disponivel)
                            <button data-open="lend-book" class="open-modal btn btn--primary btn--small width-full">
                                Emprestar
                            </button>
                        @else
                            <button class="btn btn--small btn--disabled width-full" disabled>
                                Indisponível
                            </button>
                        @endif
                        <form action="{{ route('books.toggleFix', $book->id_livro) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="icon-btn icon-btn--border {{ $book->ds_fixado ? 'icon-btn--primary' : '' }}"
                                title="{{ $book->ds_fixado ? 'Desafixar livro' : 'Fixar livro' }}">
                                @if ($book->ds_fixado == true)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M15.113 3.21l.094 .083l5.5 5.5a1 1 0 0 1 -1.175 1.59l-3.172 3.171l-1.424 3.797a1 1 0 0 1 -.158 .277l-.07 .08l-1.5 1.5a1 1 0 0 1 -1.32 .082l-.095 -.083l-2.793 -2.792l-3.793 3.792a1 1 0 0 1 -1.497 -1.32l.083 -.094l3.792 -3.793l-2.792 -2.793a1 1 0 0 1 -.083 -1.32l.083 -.094l1.5 -1.5a1 1 0 0 1 .258 -.187l.098 -.042l3.796 -1.425l3.171 -3.17a1 1 0 0 1 1.497 -1.26z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M15 4.5l-4 4l-4 1.5l-1.5 1.5l7 7l1.5 -1.5l1.5 -4l4 -4" />
                                        <path d="M9 15l-4.5 4.5" />
                                        <path d="M14.5 4l5.5 5.5" />
                                    </svg>
                                @endif
                            </button>
                        </form>
                        <div class="dropdown">
                            <button class="dropdown__btn icon-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                </svg>
                                <span class="sr-only">Mais</span>
                            </button>
                            <div class="dropdown__content dropdown__content--small dropdown__content--top">
                                <a href="{{ route('books.edit', $book->id_livro) }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                        <path d="M16 19h6" />
                                    </svg>
                                    <span>Editar</span>
                                </a>
                                {{-- <form method="POST" action="{{ route('books.destroy', $book->id_livro) }}"
                                    id="delete-form-{{ $book->id_livro }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item dropdown-item--alert open-modal"
                                        data-open="confirm-delete" data-form-id="delete-form-{{ $book->id_livro }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                        Excluir
                                    </button>
                                </form> --}}
                                <button type="button" class="dropdown-item dropdown-item--alert open-modal"
                                    data-open="confirm-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </div>

                    @if ($book->emprestimosAtivos->count())
                        <div class="margin-top-400">
                            <p class="fs-200 fw-bold heading-separation">Empréstimos ativos</p>
                            <ul>
                                @foreach ($book->emprestimosAtivos as $emprestimo)
                                    <li class="flex gap-300">
                                        <img class="circle-img circle-img--small"
                                            src="{{ !empty($emprestimo->usuario->photo_path) ? asset('storage/' . $emprestimo->usuario->photo_path) : asset('assets/img/pfp-default.png') }}"
                                            alt="Sua foto de perfil" />
                                        <p class="fc-neutral-900">
                                            <span
                                                class="fw-bold">{{ optional($emprestimo->usuario)->name ?? 'Usuário desconhecido' }}</span>
                                            (Previsto para devolução:
                                            {{ \Carbon\Carbon::parse($emprestimo->dt_devolucao)->format('d/m/Y') }})
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                @endif
            </aside>
        </div>
        <div class="modal-wrapper" data-modal="lend-book">
            <div class="modal">
                <header class="modal__header">
                    <h1 class="fs-heading-3 fw-bold">Emprestar livro</h1>
                    <button class="icon-btn close-modal" data-close="lend-book"><img
                            src="{{ asset('assets/svg/close.svg') }}"></button>
                </header>
                <form action="{{ route('books.lend', $book->id_livro) }}" method="POST">
                    @csrf
                    <div class="modal__body">
                        <div class="label-input">
                            <label class="fw-bold" for="id_usuario">Usuário</label>
                            <select class="textbox textbox--dropdown" name="id_usuario" id="id_usuario" required>
                                @if ($usuarios->isEmpty())
                                    <option value="">Nenhum usuário disponível</option>
                                @else
                                    <option value="">Selecione um usuário...</option>
                                    @foreach ($usuarios as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <footer class="modal__footer">
                        <button type="submit" class="btn btn--primary">
                            Emprestar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
        <div class="modal-wrapper" data-modal="confirm-delete">
            <div class="modal">
                <header class="modal__header">
                    <h1 class="fs-heading-3 fw-bold">Excluir livro</h1>
                    <button class="icon-btn close-modal" data-close="confirm-delete">
                        <img src="{{ asset('assets/svg/close.svg') }}">
                    </button>
                </header>
                <div class="modal__body">
                    <p class="fs-300">Tem certeza que deseja excluir <span class="fw-bold">{{ $book->nm_livro }}</span>?
                    </p>
                </div>
                <footer class="modal__footer">
                    <button class="btn btn--secondary btn--neutral close-modal"
                        data-close="confirm-delete">Cancelar</button>
                    <form method="POST" action="{{ route('books.destroy', $book->id_livro) }}"
                        id="delete-form-{{ $book->id_livro }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="library_handle" value="{{ $book->library->nm_handle }}">
                        <button type="submit" class="btn btn--primary btn--alert">Excluir</button>
                    </form>
                </footer>
            </div>
        </div>
    </section>
@endsection
