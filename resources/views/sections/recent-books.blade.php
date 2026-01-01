<section class="section-container margin-bottom-600">
    <h2 class="section-title">Adicionados Recentemente</h2>
    <div class="book-grid">
        @foreach ($recentBooks as $book)
            @include('partials.book-card', ['book' => $book])
        @endforeach
    </div>
</section>
