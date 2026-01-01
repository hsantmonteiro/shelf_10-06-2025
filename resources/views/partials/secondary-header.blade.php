<header class="secondary-header">
    <div class="flex gap-200 ai-center">
        <button class="sidebar-toggle" aria-controls="primary-sidebar" aria-expanded="false">
            <span class="sr-only">Menu</span>
        </button>
        <a href="/home" class="secondary-header__logo"><img src="{{ asset('assets/svg/logo-black.svg') }}"
                alt="Logo do Shelf" /></a>
    </div>
    <div class="flex gap-400 ai-center">
        {{-- <button class="icon-btn notif-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
            </svg>
        </button> --}}

        <div class="dropdown">
            <button class="dropdown__btn profile-btn icon-btn">
                <img src="{{ !empty(Auth::user()->photo_path) ? asset('storage/' . Auth::user()->photo_path) : asset('assets/img/pfp-default.png') }}"
                    alt="Sua foto de perfil" />
            </button>
            <div class="dropdown__content dropdown__content--medium dropdown__content--bottom">
                <header class="dropdown__header">
                    <span class="fs-100 margin-bottom-400">{{ auth()->user()->email }}</span>
                    <img class="user-pfp"
                        src="{{ !empty(Auth::user()->photo_path) ? asset('storage/' . Auth::user()->photo_path) : asset('assets/img/pfp-default.png') }}"
                        alt="Sua foto de perfil" />
                    <span class="fs-300 fw-regular lines-max-2 text-align-center">{{ auth()->user()->name }}</span>
                </header>
                <a href="/settings" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path
                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                        </path>
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                    </svg>

                    <span>Configurações</span>
                </a>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="dropdown-item dropdown-item--light-alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                            stroke-width="2">
                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2">
                            </path>
                            <path d="M15 12h-12l3 -3"></path>
                            <path d="M6 15l-3 -3"></path>
                        </svg>

                        <span>Sair</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
