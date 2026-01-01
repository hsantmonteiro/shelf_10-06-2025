<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <title>Top 10 Usuários</title>
    </head>

    <body>
        <h2>Top 10 Usuários com Mais Empréstimos</h2>
        <p>Biblioteca: {{ $library->nm_biblioteca }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Total de Empréstimos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topMembers as $member)
                    <tr>
                        <td>{{ $member->usuario->name ?? 'Desconhecido' }}</td>
                        <td>{{ $member->usuario->email ?? '-' }}</td>
                        <td>{{ $member->total }}</td>
                    </tr>
                @endforeach
            </tbody>
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
                padding: 1.5rem 1.75rem;
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
    </body>

</html>
