<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Shelf | Criar conta</title>
        <link rel="stylesheet" href="{{ asset('style/style.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet" />
    </head>

    <body class="gradient-background">
        <main class="user-form">
            <div class="flex gap-200 ai-center margin-bottom-200">
                <a class="icon-btn" href="../login">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                        <path d="M5 12l14 0"></path>
                        <path d="M5 12l6 6"></path>
                        <path d="M5 12l6 -6"></path>
                    </svg>
                    <span class="sr-only">Voltar</span>
                </a>
                <a href="/">
                    <img class="user-form__logo" src="../assets/svg/logo-black.svg" alt="Ir para Início" />
                </a>
            </div>

            <h1 class="fw-bold fs-heading-3 margin-bottom-400">Redefinir senha</h1>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="label-input">
                        <label for="email" class="fw-bold">E-mail</label>

                        <input id="email" type="email" placeholder="nome@site.com"
                            class="textbox form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="btn-footer margin-top-400">
                        <button type="submit" class="btn btn--primary">
                            Enviar link por e-mail
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </body>

</html>
