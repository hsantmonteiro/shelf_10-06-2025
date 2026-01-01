<div id="primary-sidebar__overlay"></div>
<aside class="primary-sidebar" data-visible="false">
    <div class="primary-sidebar__header flex gap-200 ai-center">
        <button class="close-menu" aria-controls="primary-sidebar" aria-expanded="true">
            <span class="sr-only">Fechar menu</span>
        </button>
        <a href="/home" class="secondary-header__logo"><img src="{{ asset('assets/svg/logo-black.svg') }}"
                alt="Logo do Shelf" /></a>
    </div>
    <nav>
        <ul class="primary-sidebar__group">
            <li>
                <a href="/home" class="sidebar-item @yield('home-item')">
                    @hasSection('home-item')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24"
                            height="24">
                            <path
                                d="M12.707 2.293l9 9c.63 .63 .184 1.707 -.707 1.707h-1v6a3 3 0 0 1 -3 3h-1v-7a3 3 0 0 0 -2.824 -2.995l-.176 -.005h-2a3 3 0 0 0 -3 3v7h-1a3 3 0 0 1 -3 -3v-6h-1c-.89 0 -1.337 -1.077 -.707 -1.707l9 -9a1 1 0 0 1 1.414 0m.293 11.707a1 1 0 0 1 1 1v7h-4v-7a1 1 0 0 1 .883 -.993l.117 -.007z">
                            </path>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                            stroke-width="2">
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                        </svg>
                    @endif
                    <span>Início</span>
                </a>
            </li>
            <li>
                <a href="/discover" class="sidebar-item  @yield('discover-item')">
                    @hasSection('discover-item')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24"
                            height="24">
                            <path
                                d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 14.66a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm3.684 -10.949l-6 2a1 1 0 0 0 -.633 .633l-2.007 6.026l-.023 .086l-.017 .113l-.004 .068v.044l.009 .111l.012 .07l.04 .144l.045 .1l.054 .095l.064 .09l.069 .075l.084 .074l.098 .07l.1 .054l.078 .033l.105 .033l.109 .02l.043 .005l.068 .004h.044l.111 -.009l.07 -.012l.02 -.006l.019 -.002l.074 -.022l6 -2a1 1 0 0 0 .633 -.633l2 -6a1 1 0 0 0 -1.265 -1.265zm-1.265 2.529l-1.21 3.629l-3.629 1.21l1.21 -3.629l3.629 -1.21zm-9.419 1.42a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm-7 -7a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z">
                            </path>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                            stroke-width="2">
                            <path d="M8 16l2 -6l6 -2l-2 6l-6 2"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 3l0 2"></path>
                            <path d="M12 19l0 2"></path>
                            <path d="M3 12l2 0"></path>
                            <path d="M19 12l2 0"></path>
                        </svg>
                    @endif
                    <span>Explorar</span>
                </a>
            </li>
        </ul>
        {{-- @forelse ($bibliotecas as $library) --}}
        @hasSection('library')
            <div class="library-group">
                <a href="{{ route('library.rules', ['library' => $currentLibraryHandle ?? $library->nm_handle]) }}" class="library-dropdown @yield('rules')">
                    <img class="library-dropdown__img"
                        src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                        alt="Foto de perfil da biblioteca">
                    <span class="lines-max-1">{{ $library->nm_biblioteca }}</span>
                </a>
                <div class="flex-column jc-space-between">
                    <ul class="primary-sidebar__group">
                        <li>
                            <a @if (isset($library) && $library) href="{{ route('library.books', ['library' => $currentLibraryHandle ?? $library->nm_handle]) }}" @endif
                                class="sidebar-item @yield('books-item')">
                                @hasSection('books-item')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.09961 6.00378H5.09961V5.00378C5.09961 4.43378 5.59961 4.00378 6.09961 4.00378H8.09961C8.59961 4.00378 9.09961 4.43015 9.09961 5.00378V6.00378Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M9.09961 10.0038H5.09961V19.0038C5.09961 19.6038 5.59961 20.0038 6.09961 20.0038H8.09961C8.59961 20.0038 9.09961 19.6038 9.09961 19.0038V10.0038Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M5.09961 10.0038H9.09961M5.09961 10.0038V19.0038C5.09961 19.6038 5.59961 20.0038 6.09961 20.0038H8.09961C8.59961 20.0038 9.09961 19.6038 9.09961 19.0038V10.0038M5.09961 10.0038V6.00378M9.09961 10.0038V6.00378M5.09961 6.00378H9.09961M5.09961 6.00378V5.00378C5.09961 4.43378 5.59961 4.00378 6.09961 4.00378H8.09961C8.59961 4.00378 9.09961 4.43015 9.09961 5.00378V6.00378"
                                            stroke="#0F69EF" stroke-width="2" />
                                        <path
                                            d="M9.09961 18.0038L13.0996 18.0038L13.0996 19.0038C13.0996 19.5738 12.5996 20.0038 12.0996 20.0038L10.0996 20.0038C9.59961 20.0038 9.09961 19.5774 9.09961 19.0038L9.09961 18.0038Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M9.09961 14.0038L13.0996 14.0038L13.0996 5.00378C13.0996 4.40378 12.5996 4.00378 12.0996 4.00378L10.0996 4.00378C9.59961 4.00378 9.09961 4.40378 9.09961 5.00378L9.09961 14.0038Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M13.0996 14.0038L9.09961 14.0038M13.0996 14.0038L13.0996 5.00378C13.0996 4.40378 12.5996 4.00378 12.0996 4.00378L10.0996 4.00378C9.59961 4.00378 9.09961 4.40378 9.09961 5.00378L9.09961 14.0038M13.0996 14.0038L13.0996 18.0038M9.09961 14.0038L9.09961 18.0038M13.0996 18.0038L9.09961 18.0038M13.0996 18.0038L13.0996 19.0038C13.0996 19.5738 12.5996 20.0038 12.0996 20.0038L10.0996 20.0038C9.59961 20.0038 9.09961 19.5774 9.09961 19.0038L9.09961 18.0038"
                                            stroke="#0F69EF" stroke-width="2" />
                                        <path
                                            d="M16.7739 18.305L20.6285 17.236L20.8957 18.1996C21.048 18.7489 20.6811 19.2969 20.1993 19.4305L18.272 19.965C17.7902 20.0986 17.1945 19.8214 17.0412 19.2686L16.7739 18.305Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M15.7049 14.4504L19.5594 13.3815L18.4946 9.54184L14.6401 10.6108L15.7049 14.4504Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M17.4269 5.6873L13.5724 6.75625L13.3052 5.79262C13.1528 5.24335 13.5197 4.69537 14.0016 4.56175L15.9288 4.02727C16.4106 3.89365 17.0064 4.1709 17.1597 4.72367L17.4269 5.6873Z"
                                            fill="#0F69EF" />
                                        <path
                                            d="M19.5594 13.3815L15.7049 14.4504M19.5594 13.3815L18.4946 9.54184M19.5594 13.3815L20.6285 17.236M15.7049 14.4504L14.6401 10.6108M15.7049 14.4504L16.7739 18.305M14.6401 10.6108L18.4946 9.54184M14.6401 10.6108L13.5724 6.75625M18.4946 9.54184L17.4269 5.6873M20.6285 17.236L16.7739 18.305M20.6285 17.236L20.8957 18.1996C21.048 18.7489 20.6811 19.2969 20.1993 19.4305L18.272 19.965C17.7902 20.0986 17.1945 19.8214 17.0412 19.2686L16.7739 18.305M13.5724 6.75625L17.4269 5.6873M13.5724 6.75625L13.3052 5.79262C13.1528 5.24335 13.5197 4.69537 14.0016 4.56175L15.9288 4.02727C16.4106 3.89365 17.0064 4.1709 17.1597 4.72367L17.4269 5.6873"
                                            stroke="#0F69EF" stroke-width="2" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        width="24" height="24" stroke-width="2">
                                        <path
                                            d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path d="M5 8h4"></path>
                                        <path d="M9 16h4"></path>
                                        <path
                                            d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z">
                                        </path>
                                        <path d="M14 9l4 -1"></path>
                                        <path d="M16 16l3.923 -.98"></path>
                                    </svg>
                                @endif
                                <span>Livros</span>
                            </a>
                        </li>
                        <li>
                            {{-- @php
                                \Illuminate\Support\Facades\Log::info('Gerando link para devolutions', [
                                    'handle' => $library->nm_handle,
                                    'id_biblioteca' => $library->id_biblioteca,
                                ]);
                            @endphp --}}
                            @if ($isManager)
                                <a href="{{ route('library.devolutions', ['library' => $currentLibraryHandle ?? $library->nm_handle]) }}"
                                    class="sidebar-item @yield('devolutions')">
                                    @hasSection('devolutions')
                                        <svg width="24" height="24" viewBox="0 -2 18 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 14H2V2H16V14ZM12.3535 5.64648C12.1583 5.45122 11.8417 5.45122 11.6465 5.64648L8.35352 8.93945C8.1583 9.1346 7.8417 9.1346 7.64648 8.93945L6.35352 7.64648L6.27539 7.58203C6.08131 7.45387 5.81735 7.47562 5.64648 7.64648C5.47562 7.81735 5.45387 8.08131 5.58203 8.27539L5.64648 8.35352L6.93945 9.64648C7.5252 10.2322 8.4748 10.2322 9.06055 9.64648L12.3535 6.35352C12.5488 6.15825 12.5488 5.84175 12.3535 5.64648Z"
                                                fill="currentColor" />
                                            <path
                                                d="M17 10V15C17 16.8856 17 17.8284 16.4142 18.4142C15.8284 19 14.8856 19 13 19H3.5C2.11929 19 1 17.8807 1 16.5M17 10C17 11.8856 17 12.8284 16.4142 13.4142C15.8284 14 14.8856 14 13 14H3.5C2.11929 14 1 15.1193 1 16.5M17 10V5C17 3.11438 17 2.17157 16.4142 1.58579C15.8284 1 14.8856 1 13 1H5C3.11438 1 2.17157 1 1.58579 1.58579C1 2.17157 1 3.11438 1 5V16.5"
                                                stroke="#0F69EF" stroke-width="2" />
                                        </svg>
                                    @else
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 12V17C20 18.8856 20 19.8284 19.4142 20.4142C18.8284 21 17.8856 21 16 21H6.5C5.11929 21 4 19.8807 4 18.5M20 12C20 13.8856 20 14.8284 19.4142 15.4142C18.8284 16 17.8856 16 16 16H6.5C5.11929 16 4 17.1193 4 18.5M20 12V7C20 5.11438 20 4.17157 19.4142 3.58579C18.8284 3 17.8856 3 16 3H8C6.11438 3 5.17157 3 4.58579 3.58579C4 4.17157 4 5.11438 4 7V18.5"
                                                stroke="currentColor" stroke-width="2" />
                                            <path
                                                d="M9 10L10.2929 11.2929C10.6834 11.6834 11.3166 11.6834 11.7071 11.2929L15 8"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    @endif
                                    <span>Devoluções</span>
                                </a>
                            @endif
                        </li>
                        <li>
                            @if ($isManager)
                                <a href="{{ route('library.statistics', ['library' => $currentLibraryHandle ?? $library->nm_handle]) }}"
                                    class="sidebar-item @yield('statistics')">
                                    @hasSection('statistics')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" width="24" height="24">
                                            <path
                                                d="M18 3a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12zm-2.293 6.293a1 1 0 0 0 -1.414 0l-2.293 2.292l-1.293 -1.292a1 1 0 0 0 -1.414 0l-3 3a1 1 0 0 0 0 1.414l.094 .083a1 1 0 0 0 1.32 -.083l2.293 -2.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -.083l2.293 -2.292l1.293 1.292a1 1 0 0 0 1.414 -1.414l-2 -2z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            width="24" height="24" stroke-width="2">
                                            <path
                                                d="M4 18v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                            </path>
                                            <path d="M7 14l3 -3l2 2l3 -3l2 2"></path>
                                        </svg>
                                    @endif
                                    <span>Estatísticas</span>
                                </a>
                            @endif
                        </li>
                        {{-- <li>
                            <a href="{{ route('library.rules', ['library' => $currentLibraryHandle ?? $library->nm_handle]) }}"
                                class="sidebar-item @yield('rules')">
                                @hasSection('rules')
                                    <svg width="24" height="24" viewBox="0 -3 18 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1 7C1 7.53043 1.21071 8.03914 1.58579 8.41421C1.96086 8.78929 2.46957 9 3 9C3.53043 9 4.03914 8.78929 4.41421 8.41421C4.78929 8.03914 5 7.53043 5 7C5 6.46957 4.78929 5.96086 4.41421 5.58579C4.03914 5.21071 3.53043 5 3 5C2.46957 5 1.96086 5.21071 1.58579 5.58579C1.21071 5.96086 1 6.46957 1 7Z"
                                            fill="#0F69EF" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3 1V5Z" fill="#0F69EF" />
                                        <path d="M3 1V5" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3 9V17Z" fill="#0F69EF" />
                                        <path d="M3 9V17" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7 13C7 13.5304 7.21071 14.0391 7.58579 14.4142C7.96086 14.7893 8.46957 15 9 15C9.53043 15 10.0391 14.7893 10.4142 14.4142C10.7893 14.0391 11 13.5304 11 13C11 12.4696 10.7893 11.9609 10.4142 11.5858C10.0391 11.2107 9.53043 11 9 11C8.46957 11 7.96086 11.2107 7.58579 11.5858C7.21071 11.9609 7 12.4696 7 13Z"
                                            fill="#0F69EF" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 1V11Z" fill="#0F69EF" />
                                        <path d="M9 1V11" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 15V17Z" fill="#0F69EF" />
                                        <path d="M9 15V17" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M13 4C13 4.53043 13.2107 5.03914 13.5858 5.41421C13.9609 5.78929 14.4696 6 15 6C15.5304 6 16.0391 5.78929 16.4142 5.41421C16.7893 5.03914 17 4.53043 17 4C17 3.46957 16.7893 2.96086 16.4142 2.58579C16.0391 2.21071 15.5304 2 15 2C14.4696 2 13.9609 2.21071 13.5858 2.58579C13.2107 2.96086 13 3.46957 13 4Z"
                                            fill="#0F69EF" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M15 1V2Z" fill="#0F69EF" />
                                        <path d="M15 1V2" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M15 6V17Z" fill="#0F69EF" />
                                        <path d="M15 6V17" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        width="24" height="24" stroke-width="2">
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M6 4v4"></path>
                                        <path d="M6 12v8"></path>
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M12 4v10"></path>
                                        <path d="M12 18v2"></path>
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M18 4v1"></path>
                                        <path d="M18 9v11"></path>
                                    </svg>
                                @endif
                                <span>Regras</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        @endif
        {{-- @empty
            <div class="primary-sidebar__group">
                <a href="/create-library" class="btn btn--primary btn--small">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span>Criar biblioteca</span>
                </a>
            </div>
        @endforelse --}}
    </nav>
</aside>
