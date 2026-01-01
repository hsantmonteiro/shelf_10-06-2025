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

            <h1 class="fw-bold fs-heading-3 margin-bottom-400">Entrar</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="label-input">
                    <label for="email" class="fw-bold">E-mail</label>

                    <input id="email" type="email"
                        class="textbox form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="nome@site.com"
                        autofocus />

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
                        autocomplete="current-password" placeholder="Senha" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <p class="fs-200 margin-bottom-400">
                    Ainda não tem uma conta?
                    <a class="hypertext" href="register">Cadastre-se</a>
                </p>

                <div class="form-check">
                    <input class="checkbox form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Continuar conectado
                    </label>
                </div>

                <div class="btn-footer margin-top-400 btn-footer--row-reverse">
                    <button type="submit" class="btn btn--primary">
                        Entrar
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn--tertiary" href="{{ route('password.request') }}">
                            Esqueceu a sua senha?
                        </a>
                    @endif
                </div>
            </form>
        </main>
    </body>

</html>
