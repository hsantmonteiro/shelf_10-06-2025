{{-- partial/book-card.blade.php --}}
<div class="book-wrapper">
    <a href="{{ route('book', $book->id_livro) }}" class="book-block">
        <img src="{{ !empty($book->photo_path) ? asset('storage/' . $book->photo_path) : asset('assets/svg/book-frame.svg') }}"
            alt="Capa de {{ $book->nm_livro }}" class="book-cover book-cover--medium">
        <div class="book-block__content">
            <h2 class="book-block__title fs-300 fw-bold lines-max-2">{{ $book->nm_livro }}</h2>
            <object><a href="{{ route('library.books', $library->nm_handle) }}?search={{ $book->autor->nm_autor }}"
                    class="subtle-link book-block__link fs-200">{{ $book->autor->nm_autor }}</a></object>
        </div>
    </a>
    <div class="book-summary">
        <div class="book-summary__content">
            <div class="padding-top-200 padding-inline-300">
                @if (!empty($book->nr_exemplar) && $book->nr_exemplar >= 1)
                    <p class="fw-bold margin-bottom-400 fc-success">
                        {{ $book->nr_exemplar }} exemplares disponíveis.
                    </p>
                @else
                    <p class="fw-bold margin-bottom-400 invalid-feedback">
                        Nenhum exemplar disponível.
                    </p>
                @endif
                <h2 class="fc-neutral-900 fs-200 margin-bottom-100 fw-bold lines-max-3">{{ $book->nm_livro }}</h2>
                @if ($book->ds_sinopse != null)
                    <p class="fc-neutral-400 fs-200 lines-max-2">
                        {{ $book->ds_sinopse }}
                    </p>
                @endif
            </div>
            <ul class="flex flex-wrap padding-300 gap-100">
                @foreach ($book->assuntos->take(3) as $assunto)
                    <li class="genre-tag">
                        <a
                            href="{{ route('library.books', $library->nm_handle) }}?search={{ $assunto->nm_assunto }}">{{ $assunto->nm_assunto }}</a>
                    </li>
                @endforeach
            </ul>
            @if (!empty($isManager) && $isManager)
                <div class="btn-footer btn-footer--space-between btn-footer--border">
                    <form action="{{ route('books.toggleFix', $book->id_livro) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn--tertiary btn--small">
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
                            {{ $book->ds_fixado ? 'Fixado' : 'Fixar' }}
                        </button>
                    </form>
                    <div class="flex gap-200">
                        <object>
                            <a href="{{ route('books.edit', $book->id_livro) }}"
                                class="btn btn--secondary btn--neutral btn--small">
                                Editar
                            </a>
                        </object>
                        <form method="POST" action="{{ route('books.destroy', $book->id_livro) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn--primary btn--alert btn--small"
                                onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
