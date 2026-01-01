@if (session('success'))
    <div class="alert-success alert-success--floating">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M5 12l5 5l10 -10"></path>
        </svg>
        {{ session('success') }}
    </div>
@endif
