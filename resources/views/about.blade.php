<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <title>Shelf | Sobre nós</title>
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
                            href="#"
                            class="header-link | header-link--active"
                        >Sobre nós</a>
                    </li>
                    <li>
                        <a
                            href="prices"
                            class="header-link"
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
        <!-- Escurece o fundo quando o menu de navegação é aberto-->
        <main id="main-content">
            <section
                class="hero-section"
                style="
                    background-color: var(--clr-accent-300);
                    padding-block: 2rem;
                "
            >
                <div class="container">
                    <div class="flow">
                        <p class="fs-heading-3 margin-bottom-400 fc-neutral-400">Sobre o Shelf</p>
                        <h1 class="fs-heading-1 fw-bold">
                            Transformando bibliotecas, conectando comunidades
                        </h1>
                    </div>
                    <img
                        class="img-size-medium"
                        src="../assets/img/isometric-library.png"
                        alt="Ilustração isométrica de uma biblioteca"
                    />
                </div>
            </section>

            <section
                class="content-section content-section--transition"
                style="--_transition-color: var(--clr-accent-300)"
            >
                <div class="container | container--card row max-width-large">
                    <img
                        class="card-img"
                        src="../assets/img/librarian-and-student.png"
                        alt="Bibliotecária instruindo uma estudante"
                    />
                    <div class="flow flow--card">
                        <div class="card-title">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                width="24"
                                height="24"
                                stroke-width="2"
                                stroke-linejoin="round"
                                stroke-linecap="round"
                                stroke="currentColor"
                            >
                                <path
                                    d="M17.286 21.09q -1.69 .001 -5.288 -2.615q -3.596 2.617 -5.288 2.616q -2.726 0 -.495 -6.8q -9.389 -6.775 2.135 -6.775h.076q 1.785 -5.516 3.574 -5.516q 1.785 0 3.574 5.516h.076q 11.525 0 2.133 6.774q 2.23 6.802 -.497 6.8"
                                >
                                </path>
                            </svg>
                            <h2>Nossa missão</h2>
                        </div>
                        <p class="fs-heading-2 fw-bold">
                            Simplificar o trabalho de bibliotecários e os
                            conectar com seus leitores.
                        </p>
                    </div>
                </div>
            </section>
            <section class="content-section">
                <div class="container | container--card row-reverse max-width-large">
                    <img
                        class="card-img"
                        src="../assets/img/bookshelf.png"
                        alt="Estante de livros"
                    />
                    <div class="flow flow--card">
                        <div class="card-title">
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
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"
                                >
                                </path>
                            </svg>
                            <h2>Nossa visão</h2>
                        </div>
                        <p class="fs-heading-2 fw-bold">
                            Tornar-se a plataforma de referência para gestão de
                            bibliotecas no mundo.
                        </p>
                    </div>
                </div>
            </section>
            <section
                class="content-section"
                style="background-color: var(--clr-accent-100)"
            >
                <div class="container container--center max-width-large">
                    <h2 class="fs-heading-2 fw-bold">Conheça a nossa equipe</h2>
                    <div class="wrap-layout">
                        <article class="profile-card">
                            <img
                                class="profile-card__img"
                                src="../assets/img/andre.png"
                                alt="Foto de André Franca"
                            />
                            <div class="flow">
                                <h3 class="fs-heading-3 margin-bottom-400">André Franca</h3>
                                <p>Engenheiro de Banco de Dados</p>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <svg
                                                arial-label="github"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-github"></use>
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
                                                arial-label="linkedin"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <article class="profile-card">
                            <img
                                class="profile-card__img"
                                src="../assets/img/guilherme.png"
                                alt="Foto de Guilherme Jesus"
                            />
                            <div class="flow">
                                <h3 class="fs-heading-3 margin-bottom-400">Guilherme Jesus</h3>
                                <p>Designer gráfico</p>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <svg
                                                arial-label="github"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-github"></use>
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
                                                arial-label="linkedin"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <article class="profile-card">
                            <img
                                class="profile-card__img"
                                src="../assets/img/henrique.png"
                                alt="Foto de Henrique Monteiro"
                            />
                            <div class="flow">
                                <h3 class="fs-heading-3 margin-bottom-400">Henrique Monteiro</h3>
                                <p>Desenvolvedor Web</p>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <svg
                                                arial-label="github"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-github"></use>
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
                                                arial-label="linkedin"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <article class="profile-card">
                            <img
                                class="profile-card__img"
                                src="../assets/img/nicolas.png"
                                alt="Foto de Nicolas Lemos"
                            />
                            <div class="flow">
                                <h3 class="fs-heading-3 margin-bottom-400">Nicolas Lemos</h3>
                                <p>Desenvolvedor Front-End</p>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <svg
                                                arial-label="github"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-github"></use>
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
                                                arial-label="linkedin"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <article class="profile-card">
                            <img
                                class="profile-card__img"
                                src="../assets/img/sidney.png"
                                alt="Foto de Sidney Nunes"
                            />
                            <div class="flow">
                                <h3 class="fs-heading-3 margin-bottom-400">Sidney Nunes</h3>
                                <p>Desenvolvedor Back-end</p>
                                <ul class="social-media">
                                    <li>
                                        <a href="#">
                                            <svg
                                                arial-label="github"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-github"></use>
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
                                                arial-label="linkedin"
                                                class="social-icon"
                                            >
                                                <use xlink:href="../assets/svg/social-icons.svg#icon-linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
            <section class="footer-transition">
                <div class="cta">
                    <h2 class="fs-heading-2 fw-bold">
                        Eleve a gestão da sua biblioteca hoje.
                    </h2>
                    <a
                        href="#"
                        class="btn | btn--secondary"
                    >Comece grátis</a>
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
                        <h2 class="fs-heading-4 margin-bottom-400">Empresa</h2>
                        <ul>
                            <li><a href="about">Sobre nós</a></li>
                            <li><a href="#">Termos de privacidade</a></li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="fs-heading-4 margin-bottom-400">Recursos</h2>
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
    <script src="../script.js"></script>

</html>
