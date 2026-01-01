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
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="{{ route('library.books', $library->nm_handle) }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Coleção {{ $collection->nm_seriecolecao }}</h1>
    </header>
    <section class="relative-body">
        @php
            $firstBookWithCover = $collection->livros->first(function ($book) {
                return !empty($book->photo_path);
            });
        @endphp
        <img src="{{ !empty($firstBookWithCover->photo_path) ? asset('storage/' . $firstBookWithCover->photo_path) : asset('assets/svg/book-frame.svg') }}"
            alt="" class="collection-banner">
        <div class="collection__content">
            <h1 class="collection__heading fs-heading-2">Coleção {{ $collection->nm_seriecolecao }}</h1>
            <div class="book-section">
                @foreach ($books as $book)
                    @include('partials.book-card', ['book' => $book, 'isManager' => $isManager])
                @endforeach
            </div>
        </div>
    </section>
@endsection
