<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <title>Shelf | Verificar E-mail</title>
        <link
            rel="stylesheet"
            href="{{ asset('style/style.css') }}"
        />
        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
        />
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet"
        />
    </head>

    <body class="gradient-background">
        <main class="user-form">
            <div class="flex gap-200 ai-center margin-bottom-200">
                <form
                    method="POST"
                    action="{{ route('verification.cancel') }}"
                >
                    @csrf
                    <button
                        type="submit"
                        class="icon-btn"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            width="24"
                            height="24"
                            stroke-width="2"
                        >
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        <span class="sr-only">Voltar</span>
                    </button>
                </form>
                <a href="/">
                    <img
                        class="user-form__logo"
                        src="../assets/svg/logo-black.svg"
                        alt="Ir para Início"
                    />
                </a>
            </div>

            <h1 class="fw-bold fs-heading-3 margin-bottom-400">Verificar E-mail</h1>

            <div class="margin-bottom-400">
                <p>Enviamos um código de 6 dígitos para <strong>{{ Auth::user()->email }}</strong>.</p>
                <p>Por favor, insira o código abaixo para verificar seu e-mail.</p>
            </div>

            @if (session('resent'))
                <div
                    class="alert alert-success"
                    role="alert"
                >
                    Um novo código de verificação foi enviado para seu e-mail.
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('verification.verify') }}"
            >
                @csrf

                <div class="label-input">
                    <label
                        for="code"
                        class="fw-bold"
                    >Código de Verificação</label>
                    <input
                        id="code"
                        type="text"
                        class="textbox form-control @error('code') is-invalid @enderror"
                        name="code"
                        required
                        autofocus
                        placeholder="000000"
                        maxlength="6"
                    />

                    @error('code')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="btn-footer btn-footer--row-reverse margin-top-400">
                    <button
                        type="submit"
                        class="btn btn--primary"
                    >
                        Verificar E-mail
                    </button>
                </div>
            </form>
            <form
                method="POST"
                action="{{ route('verification.resend') }}"
            >
                @csrf
                <button
                    type="submit"
                    class="btn btn--tertiary btn-resend"
                >
                    Reenviar código
                </button>
            </form>
        </main>
    </body>

</html>
