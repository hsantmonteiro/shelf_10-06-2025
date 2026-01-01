@extends('layouts.app')
@section('library')
    aaa
@endsection
@section('devolutions')
    sidebar-item--active
@endsection
@section('title')
    Devoluções
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Devoluções</h1>
    </header>

    <div class="main-body">
        <h2 class="fs-heading-4 fw-bold margin-bottom-400">Devoluções pendentes</h2>
        @if ($emprestimosPendentes->count() > 0)
                    <table class="table margin-bottom-600">
                        <tr>
                            <th>Usuário</th>
                            <th>Livro</th>
                            <th>Data de devolução</th>
                            <th></th>
                        </tr>
                        @foreach ($emprestimosPendentes as $emprestimo)
                            <tr>
                                <td>{{ $emprestimo->usuario->name ?? 'Usuário não encontrado' }}</td>
                                <td>{{ $emprestimo->livro->nm_livro ?? 'Livro não encontrado' }}</td>
                                <td>{{ \Carbon\Carbon::parse($emprestimo->dt_devolucao)->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('loan.devolute', $emprestimo->id_emprestimo) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn--primary btn--small">Devolver</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
        @else
            <p class="margin-x-auto fc-neutral-400 padding-400">Não há devoluções pendentes.</p>
        @endif
        <h2 class="fs-heading-4 fw-bold margin-bottom-400">Devoluções atrasadas</h2>
        @if ($emprestimosAtrasados->count() > 0)
                    <table class="table">
                        <tr>
                            <th>Usuário</th>
                            <th>Livro</th>
                            <th>Data de devolução</th>
                            <th>Multa</th>
                            <th></th>
                        </tr>
                        @foreach ($emprestimosAtrasados as $emprestimo)
                            <tr>
                                <td>{{ $emprestimo->usuario->name ?? 'Usuário não encontrado' }}</td>
                                <td>{{ $emprestimo->livro->nm_livro ?? 'Livro não encontrado' }}</td>
                                <td>{{ \Carbon\Carbon::parse($emprestimo->dt_devolucao)->format('d/m/Y') }}</td>
                                <td class="invalid-feedback">
                                    R${{ number_format($emprestimo->multa, 2, ',', '.') }}
                                </td>
                                <td>
                                    <form action="{{ route('loan.devolute', $emprestimo->id_emprestimo) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn--primary btn--small">Devolver</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
        @else
            <p class="margin-x-auto fc-neutral-400 padding-400">Não há devoluções atrasadas.</p>
        @endif
    </div>
@endsection
