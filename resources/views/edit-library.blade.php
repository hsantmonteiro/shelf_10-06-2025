@extends('layouts.app')
@section('title')
    Editar biblioteca
@endsection
@section('content')
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="../../home">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Editar biblioteca</h1>
    </header>
    <section class="main-body bg-neutral-200">
        <div class="edit-form margin-auto">
            <form action="{{ route('library.update', $library) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="edit-form__body">
                    <div class="flex even-columns">
                        <div class="flex-column">
                            <h2 class="fs-heading-4 fw-bold heading-separation">Informações Básicas</h2>
                            <div class="label-input">
                                <label class="fw-bold" for="file-upload">Foto de perfil</label>
                                <div class="margin-bottom-300">
                                    <div id="current-image">
                                        <img class="library-pfp library-pfp--large outline-neutral-400"
                                            src="{{ !empty($library->photo_path) ? asset('storage/' . $library->photo_path) : asset('assets/svg/library-frame.svg') }}"
                                            alt="Capa atual">
                                    </div>
                                    <div id="image-preview-container" style="display: none">
                                        <img class="library-pfp library-pfp--large" id="image-preview" src=""
                                            alt="Preview">
                                    </div>
                                </div>

                                <div class="btn-footer btn-footer--start">
                                    <div class="flex gap-100 ai-center">
                                        <label for="file-upload" class="btn btn--secondary btn--small w-fit-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M15 8h.01" />
                                                <path
                                                    d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                            </svg>
                                            <span class="file-upload">Inserir imagem</span>
                                            <input type="file" name="image" id="file-upload" class="display-none">
                                        </label>
                                        <button type="button" id="remove-image" class="icon-btn" style="display: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                            <span class="sr-only">Remover</span>
                                        </button>
                                    </div>
                                    @if ($library->photo_path)
                                        <label for="remove-cover" class="toggle toggle--alert">
                                            <input type="checkbox" name="remove_cover" id="remove-cover">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M15 8h.01" />
                                                <path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" />
                                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" />
                                                <path d="M22 22l-5 -5" />
                                                <path d="M17 22l5 -5" />
                                            </svg>
                                            <span>Remover</span>
                                        </label>
                                    @endif
                                </div>
                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="nm_biblioteca" class="fw-bold"> Nome de exibição</label>
                                <input class="textbox" type="text" placeholder="Biblioteca de Alexandria"
                                    name="nm_biblioteca" value="{{ old('nm_biblioteca', $library->nm_biblioteca) }}"
                                    id="biblioteca" required />
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
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M16 20.064A9 9 0 1 1 21 12v1.5a2.5 2.5 0 0 1-5 0V8m0 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <input class="textbox border-none" type="text" placeholder="alexandria_biblioteca"
                                        name="nm_handle" value="{{ old('nm_handle', $library->nm_handle) }}"
                                        id="handle" required />
                                </label>
                                @error('nm_handle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="description" class="fw-bold"> Descrição</label>
                                <textarea class="textbox lines-max-3" rows="3" type="text" name="ds_descricao"
                                    value="{{ old('ds_descricao', $library->ds_descricao) }}" id="description" placeholder="Descrição"></textarea>
                                @error('ds_descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex-column">
                            <h2 class="fs-heading-4 fw-bold heading-separation">Configurações</h2>
                            <div class="label-input">
                                <label for="fine" class="fw-bold"> Valor da multa </label>
                                <label class="textbox textbox--group  textbox--300">
                                    <span class="textbox__preffix">R$</span>
                                    <input class="textbox" type="number" name="vl_multa" step="0.01" min="0"
                                        value="{{ old('vl_multa', $library->vl_multa) }}" id="fine"
                                        placeholder="0,00" required />
                                </label>
                                @error('vl_multa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="label-input">
                                <label for="returndays" class="fw-bold"> Dias para devolução </label>
                                <input class="textbox textbox--200" type="number" name="qt_dias_devolucao"
                                    value="{{ old('qt_dias_devolucao', $library->qt_dias_devolucao) }}" id="return-days"
                                    placeholder="Ex.: 7" min="1" required />
                                @error('qt_dias_devolucao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check margin-bottom-400">
                                <input class="checkbox form-check-input" type="checkbox" name="fl_dias_uteis"
                                    id="workingdays" value="1"
                                    {{ old('fl_dias_uteis', $library->fl_dias_uteis) ? 'checked' : '' }}>
                                <label class="fw-bold form-check-label" for="workingdays"> Contar apenas dias úteis
                                </label>
                            </div>
                            <div class="label-input">
                                <label for="lendlimit" class="fw-bold"> Limite de empréstimos por pessoa </label>
                                <input class="textbox textbox--200" type="number" name="qt_limite_emprestimos"
                                    value="{{ old('qt_limite_emprestimos', $library->qt_limite_emprestimos) }}"
                                    placeholder="Ex.: 1" min="1" required>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="modal__footer">
                    <a href="/home" class="btn btn--secondary btn--neutral btn--small">Cancelar</a>
                    <button type="submit" class="btn btn--primary btn--small">Salvar</button>
                </footer>
            </form>
        </div>
    </section>
@endsection
