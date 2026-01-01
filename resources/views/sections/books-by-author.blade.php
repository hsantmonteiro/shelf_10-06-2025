<section class="section-container margin-bottom-600">
    <h2 class="section-title">Livros por Autor</h2>
    @foreach($booksByAuthor as $author => $books)
        <div class="author-section margin-bottom-400">
            <h3 class="author-title">{{ $author }}</h3>
            <div class="book-grid">
                @foreach($books as $book)
                    @include('partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </div>
    @endforeach
</section>