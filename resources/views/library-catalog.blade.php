@extends('layouts.app')
@section('library')
    aaa
@endsection
@section('books-item')
    sidebar-item--active
@endsection
@section('title')
    Livros
@endsection
@section('content')
    <header class="ui-main__header gap-100 jc-space-between">
        @if (isset($library) && $library)
            <a href="{{ route('library.books', $library->nm_handle) }}"
                class="td-none fc-neutral-900 fs-heading-3 margin-bottom-400 fw-bold">
                Livros
            </a>
        @else
            <h1 class="td-none fc-neutral-900 fs-heading-3 margin-bottom-400 fw-bold">
                Livros
            </h1>
        @endif
        <div class="search-container desktop-only">
            <form id="book-search-form" method="GET">
                <label class="textbox textbox--search">
                    <input type="text" id="book-search" name="search" placeholder="Buscar título, autor, gênero..."
                        autocomplete="off" class="textbox" value="{{ request()->input('search', '') }}">
                    <button type="submit" class="btn btn--primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </button>
                    <div id="search-suggestions" class="search-suggestions"></div>
                </label>
            </form>
        </div>
        @auth
            @isset($library)
                @if ($isManager)
                    <button data-open="add-book" class="desktop-only btn btn--primary btn--small open-modal">
                        Catalogar livro
                    </button>
                @endif
            @endisset
        @endauth
    </header>
    <div class="main-body">
        <div class="search-container mobile-only">
            <form id="book-search-form" method="GET">
                <label class="textbox textbox--search">
                    <input type="text" id="book-search" name="search" placeholder="Buscar título, autor, gênero..."
                        autocomplete="off" class="textbox" value="{{ request()->input('search', '') }}">
                    <button type="submit" class="btn btn--primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </button>
                    <div id="search-suggestions" class="search-suggestions"></div>
                </label>
            </form>
        </div>
        <div class="mobile-only">
            @auth
                @isset($library)
                    @if ($isManager)
                        <button data-open="add-book" class="btn btn--primary btn--small open-modal">
                            Catalogar livro
                        </button>
                    @endif
                @endisset
            @endauth
        </div>

        @if (empty($searchQuery) && !empty($sections))

            @if ($sections['fixedBooks']->isNotEmpty())
                <section class="margin-bottom-400">
                    <div class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--fixed" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M17.286 21.09q -1.69 .001 -5.288 -2.615q -3.596 2.617 -5.288 2.616q -2.726 0 -.495 -6.8q -9.389 -6.775 2.135 -6.775h.076q 1.785 -5.516 3.574 -5.516q 1.785 0 3.574 5.516h.076q 11.525 0 2.133 6.774q 2.23 6.802 -.497 6.8" />
                        </svg>
                        <h2 class="fs-400 fw-bold">Indicações da biblioteca</h2>
                    </div>
                    <div class="slick-carousel slick">
                        @foreach ($sections['fixedBooks'] as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($sections['mostLoanedBooks']->isNotEmpty())
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--ranking" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                            <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                            <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                        </svg>

                        <h2 class="fs-400 fw-bold">Top 10 mais emprestados</h2>
                    </section>
                    <div class="slick-carousel slick">
                        @foreach ($sections['mostLoanedBooks'] as $index => $book)
                            <div class="book-ranking">
                                <span class="book-ranking__number">{{ $index + 1 }}</span>
                                @include('partials.book-card', [
                                    'book' => $book,
                                    'isManager' => $isManager ?? false,
                                ])
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Recently Added Section -->
            {{-- @if ($sections['recentBooks']->isNotEmpty())
                <section class="margin-bottom-400">
                    <div class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--news" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path
                                d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm0 -12a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm-7 12a6 6 0 0 1 6 -6a6 6 0 0 1 -6 -6a6 6 0 0 1 -6 6a6 6 0 0 1 6 6z">
                            </path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Novidades</h2>
                    </div>
                    <div class="slick-carousel slick">
                        @foreach ($sections['recentBooks'] as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endif --}}

            @if (isset($sections['booksByCollection']) && $sections['booksByCollection']->isNotEmpty())
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--genre" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round" stroke="currentColor">
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6l0 13"></path>
                            <path d="M12 6l0 13"></path>
                            <path d="M21 6l0 13"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Coleções</h2>
                    </section>
                    <div class="collection-slider slick">
                        @foreach ($sections['booksByCollection'] as $collection)
                            <a href="{{ route('library.collection.books', [
                                'library' => $library->nm_handle,
                                'collection' => $collection->id_serieColecao,
                            ]) }}"
                                class="collection">
                                @php
                                    $firstBookWithCover = $collection->livros->first(function ($book) {
                                        return !empty($book->photo_path);
                                    });
                                @endphp
                                <div class="collection__frame lines-max-2">
                                    <img src="{{ asset($firstBookWithCover ? 'storage/' . $firstBookWithCover->photo_path : 'assets/svg/book-frame.svg') }}"
                                        alt="" class="collection__img">
                                </div>
                                <div class="collection__title">
                                    <h3>
                                        {{ $collection->nm_seriecolecao }}
                                    </h3>
                                    <span>Coleção<span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            @foreach ($sections['booksBySubject'] as $subject)
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--genre" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                            stroke="currentColor">
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6l0 13"></path>
                            <path d="M12 6l0 13"></path>
                            <path d="M21 6l0 13"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Livros de {{ $subject->nm_assunto }}</h2>
                    </section>
                    <div class="slick-carousel slick">
                        @foreach ($subject->livros as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endforeach

            @if ($sections['miscGenres']->isNotEmpty())
                <section class="margin-bottom-400">
                    <div class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--genre" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round" stroke="currentColor">
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6l0 13"></path>
                            <path d="M12 6l0 13"></path>
                            <path d="M21 6l0 13"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Gêneros diversos</h2>
                    </div>
                    <div class="slick-carousel slick">
                        @foreach ($sections['miscGenres'] as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- @foreach ($sections['booksByCollection'] as $collection)
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--collection" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                            <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                            <path d="M5 8h4"></path>
                            <path d="M9 16h4"></path>
                            <path
                                d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z">
                            </path>
                            <path d="M14 9l4 -1"></path>
                            <path d="M16 16l3.923 -.98"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Coleção {{ $collection->nm_seriecolecao }}</h2>
                    </section>
                    <div class="slick-carousel slick">
                        @foreach ($collection->livros as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endforeach --}}

            

            @if (isset($sections['booksByAuthor']) && $sections['booksByAuthor']->isNotEmpty())
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--author" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Autores</h2>
                    </section>
                    <div class="slick-carousel slick">
                        @foreach ($sections['booksByAuthor'] as $author)
                            <a href="{{ route('library.authors.books', [
                                'library' => $library->nm_handle,
                                'author' => $author->id_autor,
                            ]) }}"
                                class="author">
                                @php
                                    $firstBookWithCover = $author->livros->first(function ($book) {
                                        return !empty($book->photo_path);
                                    });
                                @endphp
                                <div class="author__frame">
                                    <img src="{{ asset($firstBookWithCover ? 'storage/' . $firstBookWithCover->photo_path : 'assets/svg/book-frame.svg') }}"
                                        alt="" class="author__img">
                                </div>

                                <div class="author__title">
                                    <h3 class="lines-max-2">{{ $author->nm_autor }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- @foreach ($sections['booksByAuthor'] as $author)
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--author" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Livros de {{ $author->nm_autor }}</h2>
                    </section>
                    <div class="slick-carousel slick">
                        @foreach ($author->livros as $book)
                            @include('partials.book-card', ['book' => $book])
                        @endforeach
                    </div>
                </section>
            @endforeach --}}

            @php
                $hasBooks =
                    isset($sections['miscAuthors']) &&
                    $sections['miscAuthors']->pluck('livros')->flatten()->isNotEmpty();
            @endphp

            @if ($hasBooks)
                <section class="margin-bottom-400">
                    <section class="flex ai-center gap-200 margin-bottom-300">
                        <svg class="section-icon section-icon--author" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        <h2 class="fs-400 fw-bold">Livros de autores diversos</h2>
                    </section>

                    <div class="slick-carousel slick">
                        @foreach ($sections['miscAuthors'] as $author)
                            @foreach ($author->livros as $book)
                                @include('partials.book-card', ['book' => $book])
                            @endforeach
                        @endforeach
                    </div>
                </section>
            @endif

        @endif

        @if ($livros->isEmpty())
            <p class="margin-auto fs-300 fc-neutral-400">
                @if (request()->has('search'))
                    Nenhum livro encontrado para "{{ request('search') }}"
                @else
                    Nenhum livro encontrado.
                @endif
            </p>
        @else
            @if (!empty(request()->input('search', '')))
                <section class="book-section">
                    @foreach ($livros as $book)
                        @php
                            $isManager = Auth::user()->managerVerify($book->id_biblioteca);
                        @endphp
                        @include('partials.book-card')
                    @endforeach
                </section>
            @endif
        @endif
    </div>
    <div class="modal-wrapper" data-modal="add-book">
        <div class="modal">
            <header class="modal__header">
                <h1 class="fs-heading-3 fw-bold">Catalogar livro</h1>
                <button class="icon-btn close-modal" data-close="add-book"><img
                        src="{{ asset('assets/svg/close.svg') }}"></button>
            </header>
            <form method="POST" action="{{ route('books.store', ['library' => request()->route('library')]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal__body">
                    <!-- Campo hidden para a biblioteca -->
                    <input type="hidden" name="id_biblioteca" id="id_biblioteca"
                        value="{{ $library->id_biblioteca }}">
                    <div class="input-group">
                        <header class="input-group__header">
                            <h2 class="fs-heading-4 fw-bold">Informações Básicas</h2>
                        </header>
                        <div class="input-group__content">
                            <div class="label-input margin-x-auto">
                                <label class="fw-bold" for="file-upload">Capa</label>
                                <div class="margin-bottom-300">
                                    <div id="current-image">
                                        <img class="book-cover book-cover--medium outline-neutral-400"
                                            src="{{ asset('assets/svg/book-frame.svg') }}" alt="Capa atual">
                                    </div>
                                    <div id="image-preview-container" style="display: none">
                                        <img class="book-cover book-cover--medium" id="image-preview" src=""
                                            alt="Preview">
                                    </div>
                                </div>
                                <div class="btn-footer btn-footer--start">
                                    <div class="flex gap-100 ai-center">
                                        <label for="file-upload" class="btn btn--secondary btn--small w-fit-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="3" stroke-linecap="round"
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
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
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
                            <div class="flex gap-500">
                                <div class="label-input">
                                    <label class="fw-bold" for="nm_livro">Título</label>
                                    <input type="text" name="nm_livro" id="nm_livro" class="textbox"
                                        placeholder="A Sociedade do Anel" required value="{{ old('nm_livro') }}">
                                    @error('nm_livro')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input w-form-600">
                                    <label class="fw-bold" for="nm_serieColecao">Série/Coleção</label>
                                    <input type="text" name="nm_serieColecao" id="nm_serieColecao" class="textbox"
                                        placeholder="O Senhor dos Anéis" value="{{ old('nm_serieColecao') }}">
                                    @error('nm_serieColecao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex gap-500">
                                <div class="label-input w-form-400">
                                    <label class="fw-bold" for="nm_autor">Autor</label>
                                    <input type="text" name="nm_autor" id="nm_autor" class="textbox"
                                        placeholder="J. R. R. Tolkien" required value="{{ old('nm_autor') }}">
                                    @error('nm_autor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input w-form-400">
                                    <label class="fw-bold" for="id_idioma">Idioma</label>
                                    <select name="id_idioma" id="id_idioma" class="textbox textbox--dropdown" required>
                                        <option class="fc-neutral-400" value="">Selecione um idioma</option>
                                        @foreach ($idiomas as $idioma)
                                            <option value="{{ $idioma->id_idioma }}"
                                                {{ old('id_idioma') == $idioma->id_idioma ? 'selected' : '' }}>
                                                {{ $idioma->nm_idioma }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_idioma')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex gap-500">
                                <div class="label-input">
                                    <label class="fw-bold label-required" for="nm_assunto">Assunto(s)</label>
                                    <input class="textbox textbox--tags" name="nm_assunto" id="nm_assunto"
                                        placeholder="Separe com Enter ou vírgula">
                                    @error('nm_assunto')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input">
                                    <label class="fw-bold" for="ds_sinopse">Sinopse</label>
                                    <textarea style="resize: none" class="textbox" name="ds_sinopse" id="ds_sinopse" placeholder="Sinopse do livro"
                                        rows="5">{{ old('ds_sinopse') }}</textarea>
                                    @error('ds_sinopse')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <header class="input-group__header">
                            <h2 class="fs-heading-4 fw-bold">Detalhes da Edição</h2>
                        </header>
                        <div class="input-group__content">
                            <div class="flex gap-500">
                                <div class="label-input">
                                    <label class="fw-bold" for="nm_editora">Editora</label>
                                    <input type="text" name="nm_editora" id="nm_editora" class="textbox"
                                        placeholder="Nome da editora" required value="{{ old('nm_editora') }}">
                                    @error('nm_editora')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input">
                                    <label for="nm_localPublicacao" class="fw-bold">Local de
                                        Publicação</label>
                                    <input type="text" name="nm_localPublicacao" id="nm_localPublicacao"
                                        class="textbox" placeholder="São Paulo, Brasil"
                                        value="{{ old('nm_localPublicacao') }}">
                                    @error('nm_localPublicacao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input">
                                    <label class="fw-bold" for="nr_anoPublicacao">Ano de Publicação</label>
                                    <input type="text" name="nr_anoPublicacao" id="nr_anoPublicacao"
                                        class="textbox textbox--200" maxlength="4" placeholder="Ex.: 1954" required
                                        value="{{ old('nr_anoPublicacao') }}">
                                    @error('nr_anoPublicacao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex gap-500">
                                <div class="label-input w-form-200">
                                    <label class="fw-bold" for="nr_volume">Volume</label>
                                    <input type="number" min="1" max="99" name="nr_volume" id="nr_volume"
                                        class="textbox" placeholder="Volume" value="{{ old('nr_volume') }}">
                                    @error('nr_volume')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input w-form-200">
                                    <label class="fw-bold" for="nr_edicao">Edição</label>
                                    <input type="number" min="1" max="99" name="nr_edicao" id="nr_edicao"
                                        class="textbox" value="{{ old('nr_edicao') }}" placeholder="Edição">
                                    @error('nr_edicao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <header class="input-group__header">
                            <h2 class="fs-heading-4 fw-bold">Classificação e Identificadores</h2>
                        </header>
                        <div class="input-group__content">
                            <div class="flex gap-500">
                                <div class="label-input w-form-600">
                                    <label class="fw-bold" for="ds_isbn">ISBN</label>
                                    <input type="text" maxlength="13" name="ds_isbn" id="ds_isbn" class="textbox"
                                        required placeholder="123-45-67890-12-3" value="{{ old('ds_isbn') }}">
                                    @error('ds_isbn')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input w-form-300">
                                    <label class="fw-bold" for="ds_cdd">CDD</label>
                                    <input type="text" name="ds_cdd" id="ds_cdd" class="textbox" required
                                        placeholder="Ex.: 123.456" value="{{ old('ds_cdd') }}">
                                    @error('ds_cdd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <header class="input-group__header">
                            <h2 class="fs-heading-4 fw-bold">Controle do Acervo</h2>
                        </header>
                        <div class="input-group__content">
                            <div class="flex gap-500">
                                <div class="label-input w-form-300">
                                    <label class="fw-bold" for="nr_exemplar">N.º de Exemplares</label>
                                    <input type="number" min="0" name="nr_exemplar" id="nr_exemplar"
                                        class="textbox textbox--200" required placeholder="Ex.: 3"
                                        value="{{ old('nr_exemplar') }}">
                                    @error('nr_exemplar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="label-input w-form-500">
                                    <label class="fw-bold" for="ds_observacao">Observações</label>
                                    <textarea style="resize: none" type="text" name="ds_observacao" id="ds_observacao" class="textbox"
                                        placeholder="Observações do livro" rows="5">{{ old('ds_observacao') }}</textarea>
                                    @error('ds_observacao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
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
    <div class="modal-wrapper" data-modal="confirm-delete">
        <div class="modal">
            <header class="modal__header">
                <h1 class="fs-heading-3 fw-bold">Excluir livro</h1>
                <button class="icon-btn close-modal" data-close="confirm-delete">
                    <img src="{{ asset('assets/svg/close.svg') }}">
                </button>
            </header>
            <div class="modal__body">
                <p class="fs-300">Tem certeza que deseja excluir este livro?</p>
            </div>
            <footer class="modal__footer">
                <button class="btn btn--secondary btn--neutral close-modal" data-close="confirm-delete">Cancelar</button>
                <form method="POST" id="delete-book-form">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="library_handle" id="delete-book-library-handle">
                    <button type="submit" class="btn btn--primary btn--alert">Excluir</button>
                </form>
            </footer>
        </div>
    </div>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
    <script type="text/javascript">
        $(document).on("ready", function() {
            $(".slick-carousel").slick({
                    lazyLoad: 'ondemand',
                    dots: false,
                    infinite: false,
                    slidesToShow: 7,
                    slidesToScroll: 6,
                    variableWidths: false,
                    responsive: [{
                            breakpoint: 1920,
                            settings: {
                                slidesToShow: 6,
                                slidesToScroll: 5
                            }
                        },
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 4
                            }
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 500,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        }
                    ]
                }),
                $(".collection-slider").slick({
                    dots: false,
                    infinite: false,
                    slidesToShow: 5,
                    slidesToScroll: 4,
                    variableWidths: false,
                    responsive: [{
                            breakpoint: 1920,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 500,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        }
                    ]
                });

            // Initial update
            updateSpecialSlides($(".slick-carousel"));
            updateSpecialSlides($(".collection-slider"));

            // Update on afterChange event
            $('.slick-carousel').on('afterChange', function(event, slick) {
                updateSpecialSlides($(this));
            });
            $('.collection-slider').on('afterChange', function(event, slick) {
                updateSpecialSlides($(this));
            });
        });

        function updateSpecialSlides($carousel) {
            // Remove all special classes first
            $carousel.find('.slick-slide').removeClass('special-slide');

            const slickInstance = $carousel.slick('getSlick');

            const currentSlide = slickInstance.currentSlide;
            const slidesToShow = slickInstance.options.slidesToShow;
            const slideCount = slickInstance.slideCount;

            // Decide how many "special" slides per row
            const specialsPerRow = slidesToShow < 3 ? 1 : 2;

            // --- Apply to visible slides ---
            const startVisibleIndex = currentSlide + slidesToShow - specialsPerRow;
            for (let i = 0; i < specialsPerRow; i++) {
                const index = startVisibleIndex + i;
                $carousel.find(`.slick-slide[data-slick-index="${index}"]`).addClass('special-slide');
            }

            // --- Apply to actual last slides only if slideCount > slidesToShow ---
            if (slideCount > slidesToShow) {
                const startLastIndex = slideCount - specialsPerRow;
                for (let i = 0; i < specialsPerRow; i++) {
                    const index = startLastIndex + i;
                    $carousel.find(`.slick-slide[data-slick-index="${index}"]`).addClass('special-slide');
                }
            }
        }
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('script/book-search.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Tagify(document.querySelector('#nm_assunto'));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const authorInput = document.querySelector('input[name="nm_autor"]');
            const titleInput = document.querySelector('input[name="nm_livro"]');
            const cutterInput = document.querySelector('input[name="ds_cutter"]');

            function generateCutter() {
                if (authorInput.value && titleInput.value) {
                    fetch('/generate-cutter', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                author: authorInput.value,
                                title: titleInput.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            cutterInput.value = data.cutter;
                        });
                }
            }

            // Gerar quando o autor ou título mudar
            authorInput.addEventListener('blur', generateCutter);
            titleInput.addEventListener('blur', generateCutter);

            // Também gerar quando a página carrega se já houver valores
            if (authorInput.value && titleInput.value) {
                generateCutter();
            }
        });
    </script>
@endsection
