@extends('layouts.app')
@section('library')
    aaa
@endsection
@section('rules')
    sidebar-item--active
@endsection
@section('title')
    Regras
@endsection
@section('content')
    <section class="main-body bg-neutral-200 ai-center">
        <div class="main-body--mw gap-600">
            <div class="info-window margin-bottom-400">
                <div class="flex gap-600 ai-center">
                    <img src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                        alt="Foto de perfil da biblioteca" class="library-pfp" />
                    <div>
                        <h2 class="fs-heading-3 fw-bold lines-max-2"> {{ $library->nm_biblioteca }} </h2>
                        <p> &commat;{{ $library->nm_handle }}</p>
                    </div>
                    @if ($isManager)
                        <a href="{{ route('library.edit', $library) }}" title="Editar"
                            class="margin-left-auto margin-bottom-auto icon-btn icon-btn--border">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                                <path d="M16 19h6" />
                            </svg>
                            <span class="sr-only">Editar</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="library-stats">
                <div class="info-window ai-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="large-icon large-icon--fine">
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                        <path d="M12 7v10" />
                    </svg>
                    <span class="fs-heading-3 fw-bold">R${{ number_format($library->vl_multa, 2, ',', '.') }}</span>
                    <p class="fc-neutral-400 fs-300">de multa</p>
                </div>
                <div class="info-window ai-center">
                    <svg class="large-icon large-icon--clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M12 7v5l3 3" />
                    </svg>
                    <span class="fs-heading-3 fw-bold">
                        {{ $library->qt_dias_devolucao }}
                    </span>
                    <p class="fc-neutral-400 fs-300">dias para devolução
                    <p>
                </div>
                <div class="info-window ai-center gap-300">
                    <!--
                                tags: [monthly-calendar, month-view, date-month, monthly-schedule, timeframe, calendar-grid, month, month-planner, monthly, date-grid]
                                version: "2.41"
                                unicode: "fd2f"
                                -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        class="large-icon large-icon--calendar" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M7 14h.013" />
                        <path d="M10.01 14h.005" />
                        <path d="M13.01 14h.005" />
                        <path d="M16.015 14h.005" />
                        <path d="M13.015 17h.005" />
                        <path d="M7.01 17h.005" />
                        <path d="M10.01 17h.005" />
                    </svg>
                    <div class="text-align-center">
                        <span class="fs-400 fw-bold">Contagem de prazo</span>
                        @if ($library->fl_dias_uteis)
                            <p class="fc-neutral-400 fs-300">Apenas dias úteis</p>
                        @else
                            <p class="fc-neutral-400 fs-300">Dias úteis e finais de semana</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
