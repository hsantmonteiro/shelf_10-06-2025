<section class="section-container margin-bottom-600">
    <h2 class="section-title">Livros por Gênero</h2>
    @foreach($booksByGenre as $genre => $books)
        <div class="genre-section margin-bottom-400">
            <h3 class="genre-title">{{ $genre }}</h3>
            <div class="book-grid">
                @foreach($books as $book)
                    @include('partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </div>
    @endforeach
</section>