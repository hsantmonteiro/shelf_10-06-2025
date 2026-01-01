<section class="section-container margin-bottom-600">
    <h2 class="section-title">Coleções</h2>
    @foreach($bookCollections as $collection => $books)
        <div class="collection-section margin-bottom-400">
            <h3 class="collection-title">{{ $collection }}</h3>
            <div class="book-grid">
                @foreach($books as $book)
                    @include('partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </div>
    @endforeach
</section>