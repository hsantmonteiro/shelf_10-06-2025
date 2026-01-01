@extends('layouts.app')
@section('title')
    Criar biblioteca
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="../home">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Criar biblioteca</h1>
    </header>
    <section class="main-body bg-neutral-200">
        <form class="user-form" action="/create-library" method="POST">
            @csrf
            <div class="label-input">
                <label for="nm_biblioteca" class="fw-bold"> Nome de exibição</label>
                <input class="textbox" type="text" placeholder="Biblioteca de Alexandria" name="nm_biblioteca"
                    value="{{ old('nm_biblioteca') }}" id="biblioteca" required />
                @error('nm_biblioteca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="label-input">
                <label for="handle" class="fw-bold"> Nome identificador</label>
                <label class="textbox textbox--group">
                    <div class="textbox__icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 20.064A9 9 0 1 1 21 12v1.5a2.5 2.5 0 0 1-5 0V8m0 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <input class="textbox border-none" type="text" placeholder="alexandria_biblioteca" name="nm_handle"
                        value="{{ old('nm_handle') }}" id="handle" required />
                </label>
                @error('nm_handle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="label-input">
                <label for="description" class="fw-bold"> Descrição</label>
                <input class="textbox lines-max-3" type="text" name="ds_descricao" value="{{ old('ds_descricao') }}"
                    id="description" placeholder="Descrição" />
                @error('ds_descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="label-input">
                <label for="fine" class="fw-bold"> Valor da multa </label>
                <label class="textbox textbox--group">
                    <span class="textbox__preffix">R$</span>
                    <input class="textbox textbox--brl lines-max-3" type="number" name="vl_multa" step="0.01"
                        min="0" value="{{ old('vl_multa') }}" id="fine" placeholder="0,00" required />
                </label>
                @error('vl_multa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="label-input">
                <label for="returndays" class="fw-bold"> Dias para devolução </label>
                <input class="textbox lines-max-3" type="number" name="qt_dias_devolucao"
                    value="{{ old('qt_dias_devolucao') }}" id="return-days" placeholder="Ex.: 7" min="1" required />
                @error('qt_dias_devolucao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check margin-bottom-400">
                <input class="checkbox form-check-input" type="checkbox" name="fl_dias_uteis" id="workingdays">
                <label class="fw-bold form-check-label" for="workingdays"> Contar apenas dias úteis </label>
            </div>
            <div class="label-input">
                <label for="lendlimit" class="fw-bold"> Limite de empréstimos por pessoa </label>
                <input class="textbox" type="number" name="qt_limite_emprestimos" placeholder="Ex.: 1" min="1"
                    required>
            </div>
            <div class="btn-footer margin-top-400">
                <a href="/home" class="btn btn--secondary btn--neutral">Cancelar</a>
                <button class="btn btn--primary">Criar biblioteca</button>
            </div>
        </form>
    </section>
@endsection
