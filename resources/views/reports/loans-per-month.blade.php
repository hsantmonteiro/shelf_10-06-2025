<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Empréstimos do mês</title>
        <link rel="stylesheet" href="{{ asset('style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/style.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet" />
    </head>

    <body>
        <h2>Relatório de Empréstimos -
            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}/{{ $year }}</h2>
        <p>Biblioteca: {{ $library->nm_biblioteca }}</p>

        <table class="table margin-bottom-600">
            <tr>
                <th>Usuário</th>
                <th>Livro</th>
                <th>Data Empréstimo</th>
                <th>Data Devolução</th>
            </tr>
            @foreach ($emprestimos as $emp)
                <tr>
                    <td>{{ $emp->usuario->name ?? '-' }}</td>
                    <td>{{ $emp->livro->nm_livro ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($emp->dt_emprestimo)->format('d/m/Y') }}</td>
                    <td>
                        {{ $emp->dt_devolucao ? \Carbon\Carbon::parse($emp->dt_devolucao)->format('d/m/Y') : 'Não devolvido' }}
                    </td>
                </tr>
            @endforeach
        </table>
    </body>

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

        .table tr:last-child {
            td {
                border-bottom: none;
            }

            td:last-child {
                border-radius: 0 0 var(--table-radius) 0;
            }
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

</html>
