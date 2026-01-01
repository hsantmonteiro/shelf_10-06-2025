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
                            class="header-link | header-link--active"
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
        <main id="main-content">
            <section class="hero-section">
                <div class="container">
                    <!-- A tag "picture" garante que a imagem mude de acordo com a largura da tela. -->
                    <picture>
                        <source
                            media="(min-width: 64em)"
                            srcset="../assets/img/hero-img.png"
                        />
                        <img
                            src="../assets/img/hero-img-mobile.png"
                            alt="Mulher adicionando um livro no computador e jovem vendo livros no celular"
                        />
                    </picture>
                    <div class="flow">
                        <h1 class="fs-heading-1 fw-bold">
                            Transforme a sua biblioteca, um clique por vez
                        </h1>
                        <p>
                            Organize seu acervo, conecte-se com seus membros e
                            automatize a gestão de empréstimos — tudo o que sua
                            biblioteca precisa em um só lugar.
                        </p>
                        <div class="btn-group">
                            <a
                                href="register"
                                class="btn | btn--primary"
                            >Comece grátis</a>
                            <a
                                href="prices"
                                class="btn | btn--secondary"
                            >Ver planos</a>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="content-section"
                style="background-color: var(--clr-accent-100)"
            >
                <div class="four-column-layout">
                    <article>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        >
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                        <h2 class="fs-heading-3 margin-bottom-400 fw-bold">
                            Catalogação rápida e fácil
                        </h2>
                        <p>
                            Catalogue seus livros com todas as informações
                            necessárias em uma interface simples e intuitiva.
                        </p>
                    </article>
                    <article>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        >
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                            <path d="M3 6l0 13"></path>
                            <path d="M12 6l0 13"></path>
                            <path d="M21 6l0 13"></path>
                        </svg>
                        <h2 class="fs-heading-3 margin-bottom-400 fw-bold">Acesso ao leitor</h2>
                        <p>
                            Compartilhe livros com os membros da sua biblioteca,
                            permitindo que reservem e renovem seus empréstimos.
                        </p>
                    </article>
                    <article>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        >
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"
                            >
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                        <h2 class="fs-heading-3 margin-bottom-400 fw-bold">Gestão inteligente</h2>
                        <p>
                            Ao realizar um empréstimo ou devolução no site, o
                            membro correspondente é notificado conforme a data
                            de devolução se aproxima.
                        </p>
                    </article>
                    <article>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        >
                            <path d="M20.942 13.021a9 9 0 1 0 -9.407 7.967"></path>
                            <path d="M12 7v5l3 3"></path>
                            <path d="M15 19l2 2l4 -4"></path>
                        </svg>
                        <h2 class="fs-heading-3 margin-bottom-400 fw-bold">
                            Atualização automática
                        </h2>
                        <p>
                            A disponibilidade dos livros é automaticamente
                            atualizada ao ser emprestados ou reservados.
                            Diminuindo o trabalho manual e economizando tempo.
                        </p>
                    </article>
                </div>
            </section>
            <section class="content-section">
                <div class="container | row-reverse max-width-medium">
                    <img
                        class="container__img"
                        src="../assets/img/woman-near-icons.png"
                        alt="Mulher com um caderno no braço usando o celular"
                    />
                    <div class="flow">
                        <h2 class="fs-heading-2 fw-bold">
                            Aumente o alcance da sua biblioteca
                        </h2>
                        <p>
                            Ao criar um nome e senha para a sua biblioteca, os
                            seus membros podem acessá-la, visualizar os livros
                            catalogados e, caso tenham se cadastrado, realizar
                            reservas e renovações.
                        </p>
                        <a
                            href="#"
                            class="btn | btn--primary"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="3"
                            >
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            <span>Buscar bibliotecas</span>
                        </a>
                    </div>
                </div>
            </section>
            <section
                class="content-section"
                style="background-color: var(--clr-accent-200)"
            >
                <div class="container | row max-width-medium">
                    <img
                        class="container__img"
                        src="../assets/img/books-and-labels.png"
                        alt="Pilha de livros com etiquetas ao redor que dizem 'aluno', 'professor' e 'livro devolvido'"
                    />
                    <div class="flow">
                        <h2 class="fs-heading-2 fw-bold">Você no comando</h2>
                        <p>
                            No Shelf, você pode definir as permissões dos
                            membros da sua biblioteca, como as de reservar
                            livros e renová-los, bem como criar cargos para
                            agrupar os membros (como professores e alunos, por
                            exemplo), permitindo que você mude o prazo da
                            devolução e o preço da multa em diferentes cargos.
                        </p>
                    </div>
                </div>
            </section>
            <section class="content-section">
                <div class="container | row-reverse max-width-medium">
                    <img
                        class="container__img"
                        src="../assets/img/book-with-icons.png"
                        alt="Figura de uma lupa sobre um livro perto de ícones representando estatísticas"
                    />
                    <div class="flow">
                        <h2 class="fs-heading-2 fw-bold">
                            Receba insights poderosos
                        </h2>
                        <p>
                            Ganhe uma visão clara da atividade da sua biblioteca
                            com a seção de estatísticas. Descubra quais são os
                            livros mais emprestados e as categorias que mais
                            atraem o interesse dos seus membros. Identifique os
                            leitores mais ativos e acompanhe as multas por
                            atrasos de devolução com facilidade.
                        </p>
                    </div>
                </div>
            </section>
            <section
                class="content-section"
                style="background-color: var(--clr-accent-100)"
            >
                <div class="container | container--long max-width-medium">
                    <div class="flow">
                        <h2 class="fs-heading-2 fw-bold">
                            Feito para todo tipo de bibliotecário
                        </h2>
                        <p>
                            A Shelf foi feita para ter uma inteface de fácil uso
                            independente da experiência em tecnologia do
                            bibliotecário que a utiliza.
                        </p>
                        <a
                            href="about"
                            class="btn | btn--tertiary"
                        >
                            <span>Ver mais</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                width="2rem"
                                height="2rem"
                                stroke-width="2"
                            >
                                <path d="M5 12l14 0"></path>
                                <path d="M15 16l4 -4"></path>
                                <path d="M15 8l4 4"></path>
                            </svg>
                        </a>
                    </div>
                    <img
                        class="interface-img"
                        src="../assets/img/interface-img.png"
                        alt="Representação da interface do Shelf em desktop"
                    />
                </div>
            </section>
            <section class="footer-transition">
                <div class="cta">
                    <h2 class="fs-heading-2 fw-bold">
                        Eleve a gestão da sua biblioteca hoje.
                    </h2>
                    <a
                        href="register"
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
    <script src="../script.js"></script>

</html>
