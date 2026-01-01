@extends('layouts.app')
@section('title')
    Configurações
@endsection
@section('content')
    <header class="ui-main__header">
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Configurações</h1>
    </header>
    <section class="main-body bg-neutral-200">
        <h2 class="fs-heading-4 margin-bottom-400 fw-bold">Informações da conta</h2>
        <div class="block-section">
            <div class="settings-item">
                <div class="flex gap-300 ai-center">
                    <svg class="fc-neutral-400 width-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                        </path>
                        <path d="M3 7l9 6l9 -6"></path>
                    </svg>
                    <div>
                        <h3 class="margin-bottom-100 fw-bold">
                            E-mail
                        </h3>
                        <span class="fc-neutral-400">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
            <button class="settings-item open-modal" data-open="update-name">
                <div class="flex gap-300 ai-center">
                    <svg class="fc-primary-400 width-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                    </svg>
                    <div>
                        <h3 class="fc-neutral-900 margin-bottom-100 fw-bold">
                            Nome completo
                        </h3>
                        <span class="fc-neutral-400 lines-max-1">{{ auth()->user()->name }}</span>
                    </div>
                </div>
                <div class="btn btn--tertiary btn--small">
                    Alterar nome
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
            </button>
            <button data-open="update-password" class="settings-item open-modal">
                <div class="flex gap-300 ai-center">
                    <svg class="fc-primary-400 width-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                        <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                    </svg>
                    <div>
                        <h3 class="fc-neutral-900 margin-bottom-100 fw-bold">
                            Senha
                        </h3>
                        <span class="fc-neutral-400 password-placeholder"></span>
                    </div>
                </div>
                <div class="btn btn--tertiary btn--small">
                    Alterar senha
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
            </button>
            <button data-open="update-picture" class="settings-item open-modal">
                <div class="flex gap-300 ai-center">
                    <img class="circle-img width-300"
                        src="{{ !empty($user->photo_path) ? asset('storage/' . $user->photo_path) : asset('../assets/img/pfp-default.png') }}"
                        alt="Sua foto de perfil" />
                    <h3 class="fc-neutral-900 margin-bottom-100 fw-bold">
                        Foto de perfil
                    </h3>
                </div>
                <div class="btn btn--tertiary btn--small">
                    Alterar imagem
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </div>
            </button>
            {{-- <a href="{{ route('settings.update-picture') }}" class="settings-item">
                    <div class="flex gap-300 ai-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_612_2699)">
                                <path d="M15 8H15.01" stroke="#0F69EF" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M6 13L8.644 10.356C8.75637 10.2435 8.88981 10.1543 9.03669 10.0934C9.18357 10.0326 9.34101 10.0012 9.5 10.0012C9.65899 10.0012 9.81643 10.0326 9.96331 10.0934C10.1102 10.1543 10.2436 10.2435 10.356 10.356L14 14"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M13 13L14.644 11.356C14.7564 11.2435 14.8898 11.1543 15.0367 11.0934C15.1836 11.0326 15.341 11.0012 15.5 11.0012C15.659 11.0012 15.8164 11.0326 15.9633 11.0934C16.1102 11.1543 16.2436 11.2435 16.356 11.356L18 13"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 8V6C4 5.46957 4.21071 4.96086 4.58579 4.58579C4.96086 4.21071 5.46957 4 6 4H8"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M4 16V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H8"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V8"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 20H18C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18V16"
                                    stroke="#0F69EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_612_2699">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <div>
                            <h3 class="fc-neutral-900 margin-bottom-100 fw-bold">
                                Foto de perfil
                            </h3>
                        </div>
                    </div>
                    <div class="btn btn--tertiary btn--small">
                        Alterar/Adicionar imagem
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                            stroke-width="2">
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </div>
                </a> --}}
        </div>
    </section>
    <div class="modal-wrapper" data-modal="update-name">
        <div class="modal">
            <header class="modal__header">
                <h1 class="fs-heading-3 fw-bold">Alterar nome</h1>
                <button class="icon-btn close-modal" data-close="update-name"><img
                        src="{{ asset('assets/svg/close.svg') }}"></button>
            </header>
            <form action="{{ route('settings.update-name.post') }}" method="POST">
                @csrf
                <div class="modal__body">
                    <div class="label-input">
                        <label for="name" class="fw-bold">Nome Completo</label>
                        <input type="text" class="textbox @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name) }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <footer class="modal__footer">
                    <button type="reset" class="btn btn--secondary btn--neutral btn--small">Limpar</button>
                    <button type="submit" class="btn btn--primary btn--small">Salvar</button>
                </footer>
            </form>
        </div>
    </div>
    <div class="modal-wrapper" data-modal="update-password">
        <div class="modal">
            <header class="modal__header">
                <h2 class="fs-heading-3 fw-bold">Alterar senha</h2>
                <button class="icon-btn close-modal" data-close="update-password"><img
                        src="{{ asset('assets/svg/close.svg') }}"></button>
            </header>
            <form action="{{ route('settings.update-password.post') }}" method="POST">
                @csrf
                <div class="modal__body">
                    <div class="label-input">
                        <label for="current_password" class="fw-bold">Senha Atual</label>
                        <input type="password" class="textbox @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password" required />
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="label-input">
                        <label for="new_password" class="fw-bold">Nova Senha</label>
                        <input type="password" class="textbox @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password" required />
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="label-input">
                        <label for="new_password_confirmation" class="fw-bold">Confirme a Nova Senha</label>
                        <input type="password" class="textbox" id="new_password_confirmation"
                            name="new_password_confirmation" required />
                    </div>
                </div>
                <footer class="modal__footer">
                    <button type="reset" class="btn btn--secondary btn--neutral btn--small">Limpar</button>
                    <button type="submit" class="btn btn--primary btn--small">Salvar</button>
                </footer>
            </form>
        </div>
    </div>
    <div class="modal-wrapper" data-modal="update-picture">
        <div class="modal">
            <header class="modal__header">
                <h2 class="fs-heading-3 fw-bold">Foto de perfil</h2>
                <button class="icon-btn close-modal" data-close="update-picture"><img
                        src="{{ asset('assets/svg/close.svg') }}"></button>
            </header>
            <form action="{{ route('settings.update-picture.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal__body ai-center">
                    <div class="margin-bottom-300">
                        <div id="current-image">
                            <img class="user-pfp user-pfp--large"
                                src="{{ !empty($user->photo_path) ? asset('storage/' . $user->photo_path) : asset('../assets/img/pfp-default.png') }}"
                                alt="Foto de perfil atual">
                        </div>
                        <div id="image-preview-container" style="display: none">
                            <img class="user-pfp user-pfp--large" id="image-preview" src="" alt="Preview">
                        </div>
                    </div>
                    <div class="btn-footer">
                        <div class="flex gap-100 ai-center">
                            <label for="file-upload" class="btn btn--secondary btn--small w-fit-content">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M15 8h.01" />
                                    <path
                                        d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                </svg>
                                <span class="file-upload">Inserir imagem</span>
                                <input type="file" name="image" id="file-upload" class="display-none"
                                    accept="image/*">
                            </label>
                            <button type="button" id="remove-image" class="icon-btn" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                                <span class="sr-only">Remover</span>
                            </button>
                        </div>
                        @if ($user->photo_path)
                            <label for="remove-cover" class="toggle toggle--alert">
                                <input type="checkbox" name="remove_cover" id="remove-cover">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M15 8h.01" />
                                    <path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" />
                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" />
                                    <path d="M22 22l-5 -5" />
                                    <path d="M17 22l5 -5" />
                                </svg>
                                <span>Remover</span>
                            </label>
                        @endif
                    </div>
                    @error('image')
                        <div class="invalid-feedback" style="margin-top: .5rem; display: block;">
                            {{ $message }}</div>
                    @enderror
                </div>
                <footer class="modal__footer">
                    <button type="reset" class="btn btn--secondary btn--neutral btn--small">Limpar</button>
                    <button type="submit" class="btn btn--primary btn--small">Salvar</button>
                </footer>
            </form>
        </div>
    @endsection
