@extends('layouts.app')

@section('library')
    aaa
@endsection

@section('title')
    Editar livro
@endsection

@section('content')
    <header class="ui-main__header gap-100">
        <a class="icon-btn" href="{{ url()->previous() }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="28" height="28"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            <span class="sr-only">Voltar</span>
        </a>
        <h1 class="fs-heading-3 margin-bottom-400 fw-bold">Editar livro</h1>
    </header>
    <div class="main-body bg-neutral-200">
        <form class="user-form user-form--large margin-auto" method="POST"
            action="{{ route('books.update', $book->id_livro) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Campo hidden para a biblioteca -->
            <input type="hidden" name="id_biblioteca" id="id_biblioteca" value="{{ $library->id_biblioteca }}">
            <div class="input-group">
                <header class="input-group__header">
                    <h2 class="fs-heading-4 fw-bold">Informações Básicas</h2>
                </header>
                <div class="input-group__content">
                    <div class="label-input">
                        <label class="fw-bold" for="file-upload">Capa</label>
                        <div class="margin-bottom-300">
                            <div id="current-image">
                                <img class="book-cover book-cover--medium outline-neutral-400"
                                    src="{{ !empty($book->photo_path) ? asset('storage/' . $book->photo_path) : asset('assets/svg/book-frame.svg') }}"
                                    alt="Capa atual">
                            </div>
                            <div id="image-preview-container" style="display: none">
                                <img class="book-cover book-cover--medium" id="image-preview" src="" alt="Preview">
                            </div>
                        </div>

                        <div class="btn-footer btn-footer--start">
                            <div class="flex gap-100 ai-center">
                                <label for="file-upload" class="btn btn--secondary btn--small w-fit-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                            @if ($book->photo_path)
                                <label for="remove-cover" class="toggle toggle--alert">
                                    <input type="checkbox" name="remove_cover" id="remove-cover">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M15 8h.01" />
                                        <path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" />
                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" />
                                        <path d="M22 22l-5 -5" />
                                        <path d="M17 22l5 -5" />
                                    </svg>
                                    <span>Remover capa</span>
                                </label>
                            @endif
                        </div>
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-500">
                        <div class="label-input">
                            <label class="fw-bold" for="nm_livro">Título</label>
                            <input type="text" name="nm_livro" id="nm_livro" class="textbox"
                                placeholder="A Sociedade do Anel" required value="{{ old('nm_livro', $book->nm_livro) }}">
                            @error('nm_livro')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input w-form-600">
                            <label class="fw-bold" for="nm_serieColecao">Série/Coleção</label>
                            <input type="text" name="nm_serieColecao" id="nm_serieColecao" class="textbox"
                                placeholder="O Senhor dos Anéis"
                                value="{{ old('nm_serieColecao', $book->serieColecao->nm_seriecolecao ?? '') }}">
                            @error('nm_serieColecao')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-500">
                        <div class="label-input w-form-400">
                            <label class="fw-bold" for="nm_autor">Autor</label>
                            <input type="text" name="nm_autor" id="nm_autor" class="textbox"
                                placeholder="J. R. R. Tolkien" required
                                value="{{ old('nm_autor', $book->autor->nm_autor ?? '') }}">
                            @error('nm_autor')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input w-form-400">
                            <label class="fw-bold" for="id_idioma">Idioma</label>
                            <select name="id_idioma" id="id_idioma" class="textbox textbox--dropdown" required>
                                <option class="fc-neutral-400" value="">Selecione um idioma</option>
                                @foreach ($idiomas as $idioma)
                                    <option value="{{ $idioma->id_idioma }}"
                                        {{ old('id_idioma', $book->id_idioma) == $idioma->id_idioma ? 'selected' : '' }}>
                                        {{ $idioma->nm_idioma }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_idioma')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-500">
                        <div class="label-input">
                            <label class="fw-bold" for="nm_assunto">Assunto(s)</label>
                            <input class="textbox" name="nm_assunto" id="nm_assunto"
                                placeholder="Separe com Enter ou vírgula"
                                value="{{ old('nm_assunto', json_encode($book->assuntos->map(fn($a) => ['value' => $a->nm_assunto]))) }}">
                            @error('nm_assunto')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input">
                            <label class="fw-bold" for="ds_sinopse">Sinopse</label>
                            <textarea style="resize: none" class="textbox" name="ds_sinopse" id="ds_sinopse" placeholder="Sinopse do livro"
                                rows="5">{{ old('ds_sinopse', $book->ds_sinopse) }}</textarea>
                            @error('ds_sinopse')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <header class="input-group__header">
                    <h2 class="fs-heading-4 fw-bold">Detalhes da Edição</h2>
                </header>
                <div class="input-group__content">
                    <div class="flex gap-500">
                        <div class="label-input">
                            <label class="fw-bold" for="nm_editora">Editora</label>
                            <input type="text" name="nm_editora" id="nm_editora" class="textbox"
                                placeholder="Nome da editora" required
                                value="{{ old('nm_editora', $book->editora->nm_editora ?? '') }}">
                            @error('nm_editora')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input">
                            <label for="nm_localPublicacao" class="fw-bold">Local de
                                Publicação</label>
                            <input type="text" name="nm_localPublicacao" id="nm_localPublicacao" class="textbox"
                                placeholder="São Paulo, Brasil"
                                value="{{ old('nm_localPublicacao', $book->localPublicacao->nm_localPublicacao ?? '') }}">
                            @error('nm_localPublicacao')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input">
                            <label class="fw-bold" for="nr_anoPublicacao">Ano de Publicação</label>
                            <input type="text" name="nr_anoPublicacao" id="nr_anoPublicacao"
                                class="textbox textbox--200" maxlength="4" placeholder="Ex.: 1954" required
                                value="{{ old('nr_anoPublicacao', $book->nr_anoPublicacao) }}">
                            @error('nr_anoPublicacao')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-500">
                        <div class="label-input w-form-200">
                            <label class="fw-bold" for="nr_volume">Volume</label>
                            <input type="number" min="1" max="99" name="nr_volume" id="nr_volume"
                                class="textbox" placeholder="Volume" value="{{ old('nr_volume', $book->nr_volume) }}">
                            @error('nr_volume')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input w-form-200">
                            <label class="fw-bold" for="nr_edicao">Edição</label>
                            <input type="number" min="1" max="99" name="nr_edicao" id="nr_edicao"
                                class="textbox" value="{{ old('nr_edicao', $book->nr_edicao) }}" placeholder="Edição">
                            @error('nr_edicao')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <header class="input-group__header">
                    <h2 class="fs-heading-4 fw-bold">Classificação e Identificadores</h2>
                </header>
                <div class="input-group__content">
                    <div class="flex gap-500">
                        <div class="label-input w-form-600">
                            <label class="fw-bold" for="ds_isbn">ISBN</label>
                            <input type="text" maxlength="13" name="ds_isbn" id="ds_isbn" class="textbox" required
                                placeholder="123-45-67890-12-3" value="{{ old('ds_isbn', $book->ds_isbn) }}">
                            @error('ds_isbn')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input w-form-300">
                            <label class="fw-bold" for="ds_cdd">CDD</label>
                            <input type="text" name="ds_cdd" id="ds_cdd" class="textbox" required
                                placeholder="Ex.: 123.456" value="{{ old('ds_cdd', $book->ds_cdd) }}">
                            @error('ds_cdd')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <header class="input-group__header">
                    <h2 class="fs-heading-4 fw-bold">Controle do Acervo</h2>
                </header>
                <div class="input-group__content">
                    <div class="flex gap-500">
                        <div class="label-input w-form-300">
                            <label class="fw-bold" for="nr_exemplar">N.º de Exemplares</label>
                            <input type="number" min="0" name="nr_exemplar" id="nr_exemplar"
                                class="textbox textbox--200" required placeholder="Ex.: 3"
                                value="{{ old('nr_exemplar', $book->nr_exemplar) }}">
                            @error('nr_exemplar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="label-input w-form-500">
                            <label class="fw-bold" for="ds_observacao">Observações</label>
                            <textarea style="resize: none" type="text" name="ds_observacao" id="ds_observacao" class="textbox"
                                placeholder="Observações do livro" rows="5">{{ old('ds_observacao', $book->ds_observacao) }}</textarea>
                            @error('ds_observacao')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-footer">
                <a href="{{ url()->previous() }}" class="btn btn--secondary btn--neutral">Cancelar</a>
                <button type="submit" class="btn btn--primary">Salvar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Tagify(document.querySelector('#nm_assunto'));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const authorInput = document.querySelector('input[name="nm_autor"]');
            const titleInput = document.querySelector('input[name="nm_livro"]');
            const cutterInput = document.querySelector('input[name="ds_cutter"]');

            function generateCutter() {
                if (authorInput.value && titleInput.value) {
                    fetch('/generate-cutter', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                author: authorInput.value,
                                title: titleInput.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            cutterInput.value = data.cutter;
                        });
                }
            }

            // Gerar quando o autor ou título mudar
            authorInput.addEventListener('blur', generateCutter);
            titleInput.addEventListener('blur', generateCutter);

            // Também gerar quando a página carrega se já houver valores
            if (authorInput.value && titleInput.value) {
                generateCutter();
            }

            // Prepare initial tags data
            const initialTags = @json(
                $book->assuntos->map(function ($a) {
                    return ['value' => $a->nm_assunto];
                }));

            // Initialize Tagify
            const tagify = new Tagify(document.querySelector('#nm_assunto'), {
                originalInputValueFormat: valuesArr => JSON.stringify(valuesArr)
            });

            // Add existing tags
            if (initialTags.length) {
                tagify.addTags(initialTags);
            }
        });
    </script>
@endsection
