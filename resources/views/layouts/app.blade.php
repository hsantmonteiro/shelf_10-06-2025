@auth
    @php
        $currentLibraryHandle = $currentLibraryHandle ?? null;
        $isManager = $isManager ?? false;
    @endphp
@endauth

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        @hasSection('title')
            @yield('title') - Shelf
        @else
            Shelf
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <script src="{{ asset('script/script.js') }}"></script>
    <script src="{{ asset('script/library-search.js') }}"></script>
    @yield('scripts')
</head>

<body class="ui-grid">
    <a href="#main-content" class="btn btn--primary skip-to-content">Ir para o conteúdo principal</a>
    @include('partials.secondary-header')
    @include('partials.primary-sidebar')
    <main class="ui-main" id="main-content">
        @include('partials.success-msg')
        @yield('content')
    </main>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
</body>

</html>
