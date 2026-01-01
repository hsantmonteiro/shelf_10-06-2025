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
                <a href="/">
                    <img class="user-form__logo" src="../assets/svg/logo-black.svg" alt="Ir para Início" />
                </a>
            </div>

            <h1 class="fw-bold fs-heading-3 margin-bottom-400">Criar conta</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="label-input">
                    <label for="name" class="fw-bold">Nome completo</label>
                    <input id="name" type="text"
                        class="textbox form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" placeholder="Nome completo"
                        autofocus />

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="label-input">
                    <label for="email" class="fw-bold">E-mail</label>

                    <input id="email" type="email"
                        class="textbox form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="nome@site.com" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="label-input">
                    <label for="password" class="fw-bold">Senha</label>

                    <input id="password" type="password"
                        class="textbox form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password" placeholder="Senha" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="label-input">
                    <label for="password-confirm" class="fw-bold">Confirmar senha</label>

                    <input id="password-confirm" type="password" class="textbox form-control"
                        name="password_confirmation" required autocomplete="new-password" placeholder="Senha" />
                </div>

                <p class="fs-200">
                    Já tem uma conta?
                    <a class="hypertext" href="login">Faça login</a>
                </p>

                <div class="btn-footer margin-top-400">
                    <button type="submit" class="btn btn--primary">
                        Criar conta
                    </button>
                </div>
            </form>
        </main>
    </body>

</html>
