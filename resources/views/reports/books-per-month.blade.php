<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title> Livros registrados em {{ $month }}/{{ $year }}</title>
    </head>

    <body>
        <h2> Livros registrados em {{ $month }}/{{ $year }}</h2>
        <p>Biblioteca: {{ $library->nm_biblioteca }}</p>
        <table class="table">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Assunto</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Idioma</th>
                <th>Local Publicação</th>
            </tr>
            </thead>
            @foreach ($livros as $livro)
                <tr>
                    <td>{{ $livro->nm_livro }}</td>
                    <td>{{ $livro->autor->nm_autor ?? '-' }}</td>
                    <td>{{ $livro->assuntos->pluck('nm_assunto')->join(', ') ?: '-' }}</td>
                    <td>{{ $livro->editora->nm_editora ?? '-' }}</td>
                    <td>{{ $livro->nr_anoPublicacao }}</td>
                    <td>{{ $livro->idioma->nm_idioma ?? '-' }}</td>
                    <td>{{ $livro->localPublicacao->nm_localPublicacao ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
        <style>
            h2 {
                font-size: 2rem;
                margin-bottom: 1.25rem;
            }

            p {
                font-size: 1.25rem;
                font-weight: 400;
                color: hsl(0, 0%, 46%);
            }

            body {
                font-family: "Inter", sans-serif;
            }

            table {
                font-family: "Inter", sans-serif;
                --table-radius: 1rem;
                /* border-radius: 1rem; */
                width: 100%;
                border-spacing: 0;
                border: 1px solid #e9e9e9;
                border-radius: var(--table-radius);
                position: relative;
                overflow: hidden;
            }

            .table td,
            .table th {
                font-family: "Inter", sans-serif;
                padding: 0.5rem 0.75rem;
                font-size: 1rem;
                border-bottom: 1px solid #e9e9e9;
                max-width: calc(40rem * 2 / 3);
            }

            .table th {
                background-color: #fafafa;
                /* border-bottom: 1px solid #c4c4c4; */
                font-weight: 600;
                text-align: start;
            }

            .table th:first-child {
                border-radius: var(--table-radius) 0 0 0;
            }

            .table th:last-child {
                border-radius: 0 var(--table-radius) 0 0;
            }

            .table tr:last-child td:first-child {
                border-radius: 0 0 0 var(--table-radius);
            }

            .table tr:last-child td {
                border-bottom: none;
            }

            .table td:last-child {
                border-radius: 0 0 var(--table-radius) 0;
            }

            .scroll-container {
                position: relative;
                overflow: hidden;
                max-width: 100%;
            }

            .scroll-content {
                width: 100%;
                max-width: 60rem;
                display: grid;
                gap: 3rem;
                overflow-x: auto;
                white-space: nowrap;
                mask-image: linear-gradient(to right,
                        transparent,
                        black 5%,
                        black 95%,
                        transparent);
            }
        </style>
    </body>

</html>
