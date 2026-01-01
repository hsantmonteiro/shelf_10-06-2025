<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <title>Shelf | Sua biblioteca em um clique</title>
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
        <script src="{{ asset('script/script.js') }}"></script>
    </head>

    <body>
        <a
            href="#main-content"
            class="btn btn--primary skip-to-content"
        >Ir para o conteúdo principal</a>
        <noscript class="alert-msg-header">
            <p>
                O JavaScript está desabilitado, algumas funções desse site podem
                não funcionar corretamente.
            </p>
        </noscript>
        <header class="primary-header">
            <a
                href="/"
                class="primary-header__logo"
            ><img
                    src="../assets/svg/logo-black.svg"
                    alt="Logo do Shelf"
                /></a>
            <nav
                class="primary-header__nav"
                data-visible="false"
            >
                <ul class="primary-header__links">
                    <li>
                        <a
                            href="/"
                            class="header-link"
                        >Início</a>
                    </li>
                    <li>
                        <a
                            href="about"
                            class="header-link"
                        >Sobre nós</a>
                    </li>
                    <li>
                        <a
                            href="prices"
                            class="header-link | header-link--active"
                        >Preços</a>
                    </li>
                </ul>
                <ul class="primary-header__btns">
                    <li>
                        <a
                            href="login"
                            class="btn | btn--header btn--secondary"
                        >Entrar</a>
                    </li>
                    <li>
                        <a
                            href="register"
                            class="btn | btn--header btn--primary"
                        >Comece grátis</a>
                    </li>
                </ul>
            </nav>
            <button
                class="menu-btn"
                aria-controls="primary-header__nav"
                aria-expanded="false"
            >
                <span class="sr-only">Menu</span>
            </button>
        </header>
        <div id="primary-header__overlay"></div>
        <main id="main-content">
            <section class="content-section">
                <div class="container container--center max-width-medium">
                    <h1 class="fs-heading-1 fw-bold">
                        Escolha o plano ideal para a sua biblioteca
                    </h1>
                    <form class="option-group">
                        <label class="option-btn option-btn--active">
                            <input
                                checked
                                type="radio"
                                id="monthly"
                                name="subscription"
                            />Mensal</label>
                        <label class="option-btn option-btn--active">
                            <input
                                type="radio"
                                id="annual"
                                name="subscription"
                            />Anual</label>
                    </form>
                    <noscript>
                        <p class="alert-msg">
                            Para visualizar todas as opções de planos, ative o
                            JavaScript em seu navegador.
                        </p>
                    </noscript>
                    <div class="wrapper">
                        <article class="subscription">
                            <header class="subscription__header">
                                <h2 class="fs-heading-4 margin-bottom-400 fw-bold">Individual</h2>
                            </header>
                            <p class="subscription__price">R$0</p>
                            <p class="fc-neutral-900 subscription__desc">
                                Plano simplificado onde o único usuário é o
                                bibliotecário. Ideal para iniciantes no
                                software.
                            </p>
                            <a
                                href="register"
                                class="btn btn--secondary"
                            >Cadastre-se</a>
                            <ul class="subscription__checklist">
                                <li>Interface do bibliotecário</li>
                                <li>Catalogação de livros</li>
                                <li>Gestão de empréstimos e devoluções</li>
                            </ul>
                        </article>
                        <article class="subscription">
                            <header class="subscription__header">
                                <h2 class="fs-heading-4 margin-bottom-400 fw-bold">
                                    Profissional
                                </h2>
                                <p class="info-chip">Recomendado</p>
                            </header>
                            <p class="subscription__price">
                                R$<span class="price-text"><noscript
                                        class="loading loading--large"></noscript></span><span
                                    class="frequency-text"><noscript class="loading loading--small"></noscript></span>
                            </p>
                            <noscript>
                                <style>
                                    .subscription__price {
                                        display: flex;
                                        align-items: flex-end;
                                    }
                                </style>
                            </noscript>
                            <p class="fc-neutral-900 subscription__desc">
                                A solução completa para gerenciar sua biblioteca
                                com eficiência e praticidade.
                            </p>
                            <a
                                href="register"
                                class="btn btn--primary"
                            >Comece já</a>
                            <ul class="subscription__checklist">
                                <li>Tudo do plano Individual</li>
                                <li>
                                    Conexão com membros da biblioteca através de
                                    um ID único.
                                </li>
                                <li>
                                    Interface do leitor para acessar livros
                                    disponíveis, visualizar empréstimos atuais e
                                    reservar livros.
                                </li>
                                <li>Separação de membros por cargos</li>
                                <li>
                                    Notificações automáticas por e-mail para
                                    membros sobre reservas e devoluções
                                </li>
                                <li>
                                    Seção de estatísticas sobre empréstimos e
                                    devoluções
                                </li>
                            </ul>
                        </article>
                    </div>
                </div>
            </section>
        </main>
        <footer class="primary-footer">
            <div class="container">
                <div class="primary-footer__logo-social">
                    <a href="/">
                        <img
                            class="primary-footer__logo"
                            src="../assets/svg/logo-white.svg"
                            alt="Logo do Shelf"
                        />
                    </a>
                    <ul class="social-media">
                        <li>
                            <a href="#">
                                <svg
                                    arial-label="linkedin"
                                    class="social-icon"
                                >
                                    <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg
                                    arial-label="instagram"
                                    class="social-icon"
                                >
                                    <use xlink:href="../assets/svg/social-icons.svg#icon-instagram"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg
                                    arial-label="facebook"
                                    class="social-icon"
                                >
                                    <use xlink:href="../assets/svg/social-icons.svg#icon-facebook"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg
                                    arial-label="youtube"
                                    class="social-icon"
                                >
                                    <use xlink:href="../assets/svg/social-icons.svg#icon-youtube"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <nav class="primary-footer__nav">
                    <div>
                        <h2 class="fs-heading-4 margin-bottom-400 fw-bold">Empresa</h2>
                        <ul>
                            <li><a href="about">Sobre nós</a></li>
                            <li><a href="#">Termos de privacidade</a></li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="fs-heading-4 margin-bottom-400 fw-bold">Recursos</h2>
                        <ul>
                            <li><a href="prices">Preços</a></li>
                            <li><a href="#">Buscar bibliotecas</a></li>
                        </ul>
                    </div>
                </nav>
                <span class="primary-footer__copyright">&copy; 2025 Shelf. Todos os direitos reservados.</span>
            </div>
        </footer>
    </body>

</html>
