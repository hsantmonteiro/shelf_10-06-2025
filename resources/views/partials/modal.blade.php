<div class="modal-wrapper" data-modal="@yield('data-modal')">
    <div class="modal">
        <header class="modal__header">
            <h1 class="fs-heading-3 fw-bold">@yield('title')</h1>
            <button class="icon-btn close-modal" data-close="create-library"><img
                    src="{{ asset('assets/svg/close.svg') }}"></button>
        </header>
        <form action="/create-library" method="POST">
            @csrf
            <div class="modal__body">
                @yield('body')
            </div>
            <footer class="modal__footer">
                <button type="reset" class="btn btn--secondary btn--neutral btn--small">Limpar</button>
                <button type="submit" class="btn btn--primary btn--small">Salvar</button>
            </footer>
        </form>
    </div>
</div>
