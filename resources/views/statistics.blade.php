@extends('layouts.app')
@section('library')
    aaa
@endsection
@section('statistics')
    sidebar-item--active
@endsection
@section('content')
    <header class="ui-main__header">
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold"> Estatísticas </h1>
    </header>
    <section class="main-body bg-neutral-200 ai-center">
        <div class="main-body--mw gap-600">
            <div class="info-window">
                <div class="flex gap-600 ai-center">
                    <img src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                        alt="Foto de perfil da biblioteca" class="library-pfp" />
                    <div>
                        <h2 class="fs-heading-3 fw-bold"> {{ $library->nm_biblioteca }} </h2>
                        <p> &commat;{{ $library->nm_handle }} &bull; {{ $libraryMembers }} membros</p>
                    </div>
                </div>
            </div>
            <div class="info-window">
                <h3 class="fw-bold fs-400 heading-separation"> Livros mais emprestados </h3>
                <div class="info-window__content gap-700">
                    <div class="book-ranking">
                        <span class="book-ranking__number">1</span>
                        <div class="book-block--width">@include('partials.book-card', ['book' => $mostLoanedBook])</div>
                    </div>
                    <div class="books-chart">
                        <canvas class="graphs mostloanedchart" id="mostLoanedBooksChart"></canvas>
                    </div>
                </div>
                <div class="btn-footer margin-top-400">
                    <a href="{{ route('report.most-loaned-books', ['handle' => $library->nm_handle]) }}"
                        class="btn btn--primary" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        <span>Gerar relatório</span>
                    </a>
                </div>
            </div>

            <div class="info-window">
                <h3 class="fw-bold fs-400 heading-separation"> Usuários mais ativos </h3>
                <div class="info-window__content gap-700 ">
                    <div class="flex flex-column gap-200 ai-center">
                        <p class="fc-primary-400 fs-300 margin-bottom-200 fw-bold">1º lugar</p>
                        <div class="ow-400 oc-primary-400 circle-img circle-img--medium margin-bottom-200 ">
                            <img src="{{ !empty($topMember->photo_path) ? asset('storage/' . $topMember->photo_path) : asset('assets/img/pfp-default.png') }}"
                                alt="Sua foto de perfil" />
                        </div>
                        <span class="fs-300 fw-bold lines-max-2 text-align-center">{{ $labelTopMember }}</span>
                        <p class="fc-neutral-400 fs-200">{{ $dataTopMember }} livros</p>
                    </div>
                    <div class="books-chart">
                        <canvas class="graphs topmemberschart" id="topMembersChart"></canvas>
                    </div>
                </div>
                <div class="btn-footer margin-top-400">
                    <a href="{{ route('report.top-members', ['handle' => $library->nm_handle]) }}" class="btn btn--primary"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        <span>Gerar relatório</span>
                    </a>
                </div>
            </div>

            <div class="grid-area-stats gap-600 ">
                <div class="info-window grid ai-center" id="books-registered">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="large-icon large-icon--registered">
                        <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                        <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                        <path d="M5 8h4" />
                        <path d="M9 16h4" />
                        <path
                            d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                        <path d="M14 9l4 -1" />
                        <path d="M16 16l3.923 -.98" />
                    </svg>
                    <span class="fs-heading-3 fw-bold">{{ $libraryBooks }}</span>
                    <p>livros cadastrados</p>
                </div>
                <div class="info-window grid ai-center" id="books-loaned">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="large-icon large-icon--loaned">
                        <path d="M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5" />
                        <path d="M11 16h-5a2 2 0 0 0 -2 2" />
                        <path d="M15 16l3 -3l3 3" />
                        <path d="M18 13v9" />
                    </svg>
                    <span class="fs-heading-3 fw-bold">{{ $allLoans }}</span>
                    <p>livros emprestados</p>
                </div>
                <div class="info-window" id="devolutions-graph">
                    <h3 class="fw-bold fs-400 heading-separation"> Resultado das devoluções </h3>
                    <div class="center-graph">
                        <canvas class="graphs ratechart" id="returnRateChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="info-window">
                <h3 class="fw-bold fs-400 heading-separation"> Empréstimos por mês </h3>
                <canvas class="graphs loansPerMonth" id="loansPerMonth"></canvas>
                <form class="report-form margin-top-400"
                    action="{{ route('report.loansPerMonth', ['handle' => $library->nm_handle]) }}" method="GET"
                    target="_blank">
                    <div class="label-input month-field">
                        <label class="fw-bold" for="month">Mês</label>
                        <select class="textbox textbox--dropdown" name="month" id="month" required>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}">
                                    {{ ucfirst(\Carbon\Carbon::create()->month($m)->translatedFormat('F')) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="label-input year-field">
                        <label class="fw-bold" for="year">Ano</label>
                        <select class="textbox textbox--dropdown" name="year" id="year" required>
                            @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn--primary report-btn"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        <span>Gerar relatório do mês</span>
                    </button>
                </form>
            </div>

            <div class="info-window">
                <h3 class="fw-bold fs-400 heading-separation"> Registros de livros por mês </h3>
                <canvas class="graphs booksPerMonth" id="booksPerMonth"></canvas>
                <form class="report-form margin-top-400"
                    action="{{ route('report.booksPerMonth', ['handle' => $library->nm_handle]) }}" method="GET"
                    target="_blank" class="flex">
                    <div class="label-input month-field">
                        <label for="month">Mês:</label>
                        <select name="month" id="month" class="textbox textbox--dropdown" required>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}">
                                    {{ ucfirst(\Carbon\Carbon::create()->month($m)->translatedFormat('F')) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="label-input year-field">
                        <label for="year">Ano:</label>
                        <select name="year" id="year" class="textbox textbox--dropdown" required>
                            @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn--primary report-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        <span>Gerar relatório do mês</span>
                    </button>
                </form>
            </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const chartColors1 = [
                '#b0cdfa',
                '#8fb9f6',
                '#6ea5f2',
                '#4d91ee',
                '#2c7dea',
                '#0b69e6',
                '#0a5ecc',
                '#094fb3',
                '#084299',
                '#073580',
                '#062866',
                '#051b4d'
            ];

            const chartColors2 = [
                '#EDAF10', // base dourado escuro
                '#F1B71D',
                '#F5BF27',
                '#F5C336',
                '#F5C73E',
                '#F6CB4C',
                '#F6CE55',
                '#F8D36A',
                '#F9D77A',
                '#FBDB86',
                '#FBE19B',
                '#FCE6AF' // dourado pastel claro
            ]

            const chartColors3 = [
                '#4B3A75', // mais escuro
                '#5A4385',
                '#674F99', // original roxo escuro
                '#7D66A8',
                '#947CBA',
                '#A892C8',
                '#B2A6CC', // original lavanda
                '#C6B9DB',
                '#D9CCE9',
                '#E3DBF3',
                '#EDE9FA',
                '#E8EEFE' // azul quase branco
            ]

            const chartColors4 = [
                '#FA9A9A', // vermelho claro, mas ainda perceptível
                '#F58C8C',
                '#ED7C7C',
                '#E36B6B',
                '#D65C5C',
                '#C54A4A', // tom médio
                '#AF3939',
                '#9A2A2A',
                '#851F1F',
                '#701818', // vermelho escuro original
                '#5C1111',
                '#4A0D0D' // vermelho mais escuro
            ];

            // Script do gráfico de Livros mais emprestados.

            const ctx = document.getElementById('mostLoanedBooksChart');
            new Chart(ctx, {
                type: 'bar',
                flexbox: 'false',
                data: {
                    labels: {!! json_encode($labelsMostLoanedBooks) !!},
                    datasets: [{
                        data: {!! json_encode($dataMostLoanedBooks) !!},
                        backgroundColor: chartColors2,
                        borderColor: chartColors2,
                        borderWidth: 0.5,
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    responsive: true
                }
            });

            // Script dos Usuários com mais empréstimos

            const ctx2 = document.getElementById('topMembersChart');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labelsTopMembers) !!},
                    datasets: [{
                        data: {!! json_encode($dataTopMembers) !!},
                        backgroundColor: chartColors3,
                        borderColor: chartColors3,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Script do gráfico das devoluções no prazo

            const ctx3 = document.getElementById('returnRateChart');
            new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($labelsReturnRate) !!},
                    datasets: [{
                        data: {!! json_encode($dataReturnRate) !!},
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Script do gráfico de quantidade de livros emprestados por mês

            const ctx4 = document.getElementById('loansPerMonth');

            new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labelsLoansPerMonth) !!}, // meses reais do select
                    datasets: [{
                        data: {!! json_encode($dataLoansPerMonth) !!}, // totais reais do select
                        backgroundColor: chartColors1,
                        borderColor: chartColors1,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Script do gráfico de quantidade de livros registrados por mês

            const ctx5 = document.getElementById('booksPerMonth');

            new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labelsBooksPerMonth) !!}, // meses reais do select
                    datasets: [{
                        data: {!! json_encode($dataBooksPerMonth) !!}, // totais reais do select
                        backgroundColor: chartColors4,
                        borderColor: chartColors4,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Quantidade de livros registrados por Mês"
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>
@endsection
