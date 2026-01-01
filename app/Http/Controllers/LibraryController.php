<?php

namespace App\Http\Controllers;

use App\Services\CutterService;
use App\Models\Library;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use App\Models\Subject;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Author;
use App\Models\BookSubject;
use App\Models\Language;
use App\Models\CollectionSeries;
use App\Models\Publisher;
use App\Models\PublicationPlace;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class LibraryController extends Controller
{
    public function managerVerify($libraryId)
    {
        return DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $libraryId)
            ->exists();
    }

    public function createLibrary(Request $request)
    {
        $fields = $request->validate([
            'nm_biblioteca' => ['required', 'string', 'max:45'],
            'nm_handle' => [
                'required',
                'string',
                'max:30',
                'regex:/^[a-z0-9_.]+$/',
                Rule::unique('tb_biblioteca', 'nm_handle')
            ],
            'ds_descricao' => ['nullable', 'string', 'max:120'],
            'vl_multa' => ['nullable', 'numeric', 'min:0'],
            'fl_dias_uteis' => ['nullable'],
            'qt_dias_devolucao' => ['nullable', 'numeric', 'min:0'],
            'qt_limite_emprestimos' => ['nullable', 'numeric', 'min:0'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nm_biblioteca.required' => 'O nome da biblioteca é obrigatório.',
            'nm_biblioteca.max' => 'O nome da biblioteca não pode ter mais de 45 caracteres.',
            'nm_handle.required' => 'O identificador da biblioteca é obrigatório.',
            'nm_handle.max' => 'O identificador não pode ter mais de 30 caracteres.',
            'nm_handle.unique' => 'Este identificador já está em uso.',
            'nm_handle.regex' => 'O identificador só pode conter letras minúsculas, números, sublinhados e pontos.',
            'ds_descricao.max' => 'A descrição não pode ter mais de 120 caracteres.',
            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png ou jpg.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ]);

        $fields['nm_biblioteca'] = strip_tags($fields['nm_biblioteca']);
        $fields['nm_handle'] = strip_tags($fields['nm_handle']);
        // $fields['ds_descricao'] = strip_tags($fields['ds_descricao']);
        $fields['ds_descricao'] = isset($fields['ds_descricao']) ? strip_tags($fields['ds_descricao']) : null;
        $fields['fl_dias_uteis'] = $request->boolean('fl_dias_uteis');
        $fields['vl_multa'] = str_replace(',', '.', $fields['vl_multa']);

        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $size = $request->file('image')->getSize();
            $path = $request->file('image')->store('images', 'public');

            $fields['photo_name'] = $name;
            $fields['photo_size'] = $size;
            $fields['photo_path'] = $path;
        }

        $library = Library::create($fields);
        $libraryId = $library->id_biblioteca;

        DB::table('tb_gestor_biblioteca')->insert([
            'id_usuario' => Auth::id(),
            'id_biblioteca' => $libraryId,
        ]);

        return redirect('/home')->with('success', 'Biblioteca criada com sucesso!');
    }

    public function deleteLibrary(Library $library)
    {
        $isManager = Auth::user()->managerVerify($library->id_biblioteca);

        $library->delete();

        return back()->with('success', 'Biblioteca excluída com sucesso!');
    }

    public function editLibrary(Library $library)
    {
        $isManager = Auth::user()->managerVerify($library->id_biblioteca);

        return view('edit-library', ['library' => $library]);
    }

    public function updateLibrary(Request $request, Library $library)
    {
        $isManager = Auth::user()->managerVerify($library->id_biblioteca);

        if (!$isManager) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar esta biblioteca.');
        }

        $fields = $request->validate([
            'nm_biblioteca' => ['required', 'string', 'max:45'],
            'nm_handle' => [
                'required',
                'string',
                'max:30',
                'regex:/^[a-z0-9_.]+$/',
                Rule::unique('tb_biblioteca', 'nm_handle')->ignore($library->id_biblioteca, 'id_biblioteca')
            ],
            'ds_descricao' => ['nullable', 'string', 'max:120'],
            'vl_multa' => ['nullable', 'numeric', 'min:0'],
            'fl_dias_uteis' => ['nullable', 'boolean'],
            'qt_dias_devolucao' => ['nullable', 'numeric', 'min:0'],
            'qt_limite_emprestimos' => ['nullable', 'numeric', 'min:0']
        ], [
            'nm_biblioteca.required' => 'O nome da biblioteca é obrigatório.',
            'nm_biblioteca.max' => 'O nome da biblioteca não pode ter mais de 45 caracteres.',
            'nm_handle.required' => 'O identificador da biblioteca é obrigatório.',
            'nm_handle.max' => 'O identificador não pode ter mais de 30 caracteres.',
            'nm_handle.unique' => 'Este identificador já está em uso.',
            'nm_handle.regex' => 'O identificador só pode conter letras minúsculas, números, sublinhados e pontos.',
            'ds_descricao.max' => 'A descrição não pode ter mais de 120 caracteres.'
        ]);

        // Convert checkbox value to boolean
        $fields['fl_dias_uteis'] = $request->has('fl_dias_uteis') ? 1 : 0;

        $fields['nm_biblioteca'] = strip_tags($fields['nm_biblioteca']);
        $fields['nm_handle'] = strip_tags($fields['nm_handle']);
        // $fields['ds_descricao'] = strip_tags($fields['ds_descricao']);
        $fields['ds_descricao'] = isset($fields['ds_descricao']) ? strip_tags($fields['ds_descricao']) : null;

        // First: handle image removal
        if ($request->has('remove_cover') && $library->photo_path) {
            Storage::disk('public')->delete($library->photo_path);

            $fields['photo_name'] = null;
            $fields['photo_size'] = null;
            $fields['photo_path'] = null;
        } elseif ($request->hasFile('image')) {
            // Upload new image
            $name = $request->file('image')->getClientOriginalName();
            $size = $request->file('image')->getSize();
            $path = $request->file('image')->store('images', 'public');

            $fields['photo_name'] = $name;
            $fields['photo_size'] = $size;
            $fields['photo_path'] = $path;
        } else {
            // Retain current image
            $fields['photo_name'] = $library->photo_name;
            $fields['photo_size'] = $library->photo_size;
            $fields['photo_path'] = $library->photo_path;
        }

        $library->update($fields);

        return redirect('/home')->with('success', 'Biblioteca atualizada com sucesso!');
    }

    public function joinLibrary($id)
    {
        $userId = Auth::id();

        $exists = DB::table('tb_usuario_biblioteca')
            ->where('id_usuario', $userId)
            ->where('id_biblioteca', $id)
            ->exists();

        if (!$exists) {
            DB::table('tb_usuario_biblioteca')->insert([
                'id_usuario' => $userId,
                'id_biblioteca' => $id,
            ]);
        }

        return redirect()->back();
    }

    public function leaveLibrary($id)
    {
        $userId = Auth::id();

        DB::table('tb_usuario_biblioteca')
            ->where('id_usuario', $userId)
            ->where('id_biblioteca', $id)
            ->delete();

        return redirect()->back();
    }

    public function managedLibraries()
    {
        return $this->belongsToMany(Library::class, 'tb_gestor_biblioteca', 'id_usuario', 'id_biblioteca');
    }

    public function memberLibraries()
    {
        return $this->belongsToMany(Library::class, 'tb_usuario_biblioteca', 'id_usuario', 'id_biblioteca');
    }

    public function index()
    {
        // Check if user is authenticated first
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Load relationships if they exist
        if (method_exists($user, 'managedLibraries')) {
            $user->load('managedLibraries');
        }

        if (method_exists($user, 'memberLibraries')) {
            $user->load('memberLibraries');
        }

        $todasBibliotecas = Library::all();

        return view('discover', [
            'todasBibliotecas' => $todasBibliotecas,
        ]);
    }

    public function showCatalog($handle, Request $request)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $idiomas = DB::table('tb_idioma')->orderBy('nm_idioma')->get();

        $isManager = Auth::check() ? DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $library->id_biblioteca)
            ->exists() : false;

        $booksQuery = Book::with(['autor', 'assuntos', 'editora', 'seriecolecao'])
            ->where('id_biblioteca', $library->id_biblioteca);

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $booksQuery->where(function ($q) use ($searchTerm) {
                $q->where('nm_livro', 'LIKE', $searchTerm)
                    ->orWhereHas('autor', function ($q) use ($searchTerm) {
                        $q->where('nm_autor', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('assuntos', function ($q) use ($searchTerm) {
                        $q->where('nm_assunto', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('editora', function ($q) use ($searchTerm) {
                        $q->where('nm_editora', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('serieColecao', function ($q) use ($searchTerm) {
                        $q->where('nm_seriecolecao', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('idioma', function ($q) use ($searchTerm) {
                        $q->where('nm_idioma', 'LIKE', $searchTerm);
                    });
            });
        }

        $livros = $booksQuery->get();

        // Get data for sections only if not searching
        $sections = [];
        if (!$request->has('search') || empty($request->search)) {

            $sections['fixedBooks'] = Book::where('id_biblioteca', $library->id_biblioteca)
                ->where('ds_fixado', true)
                ->orderByDesc('dt_fixado')
                ->get();

            // Recently Added (last 7 days)
            $sections['recentBooks'] = Book::where('id_biblioteca', $library->id_biblioteca)
                ->where('dt_registro', '>=', now()->subDays(7))
                ->orderBy('dt_registro', 'desc')
                // ->limit(5)
                ->get();

            // Books by Subject (genres)
            $sections['booksBySubject'] = Subject::whereHas('livros', function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca);
            })
                ->with([
                    'livros' => function ($q) use ($library) {
                        $q->where('id_biblioteca', $library->id_biblioteca);
                    }
                ])
                ->get()
                ->filter(fn($subject) => $subject->livros->count() >= 6);

            // Miscellaneous Genres
            $popularSubjectIds = Subject::whereHas('livros', function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca);
            })
                ->withCount(['livros' => function ($q) use ($library) {
                    $q->where('id_biblioteca', $library->id_biblioteca);
                }])
                ->get()
                ->filter(fn($subject) => $subject->livros_count >= 6)
                ->pluck('id_assunto');

            // Passo 2: Livros da biblioteca que NÃO estão em nenhum desses assuntos
            $booksWithPopularSubjects = DB::table('tb_livroassunto')
                ->whereIn('id_assunto', $popularSubjectIds)
                ->pluck('id_livro')
                ->unique();

            $sections['miscGenres'] = Book::where('id_biblioteca', $library->id_biblioteca)
                ->whereNotIn('id_livro', $booksWithPopularSubjects)
                ->with('assuntos') // se quiser mostrar os gêneros também
                ->get();


            // Books by Collection (series with at least 2 books)
            $sections['booksByCollection'] = CollectionSeries::whereHas('livros', function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca);
            }, '>=', 2)
                ->with([
                    'livros' => function ($q) use ($library) {
                        $q->where('id_biblioteca', $library->id_biblioteca);
                    }
                ])
                ->get();

            // Books by Author (authors with multiple books)
            $sections['booksByAuthor'] = Author::whereHas('livros', function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca);
            }, '>=', 2)
                ->with([
                    'livros' => function ($q) use ($library) {
                        $q->where('id_biblioteca', $library->id_biblioteca);
                    }
                ])
                ->get();

            $sections['miscAuthors'] = Author::whereHas('livros', function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca);
            }, '<', 4)
                ->withCount([
                    'livros as livros_count' => function ($q) use ($library) {
                        $q->where('id_biblioteca', $library->id_biblioteca);
                    }
                ])
                ->with([
                    'livros' => function ($q) use ($library) {
                        $q->where('id_biblioteca', $library->id_biblioteca);
                    }
                ])
                ->orderByDesc('livros_count')
                ->get();

            $sections['mostLoanedBooks'] = $library->books()
                ->whereHas('emprestimos')
                ->withCount('emprestimos')
                ->with(['autor', 'assuntos']) // Optional: to preload relations for the book-card
                ->orderByDesc('emprestimos_count')
                ->take(10)
                ->get();
        }

        return view('library-catalog', [
            'library' => $library,
            'livros' => $livros,
            'isManager' => $isManager,
            'searchQuery' => $request->search ?? '',
            'sections' => $sections ?? [],
            'currentLibraryHandle' => $handle,
            'idiomas' => $idiomas
        ]);
    }

    public function autocompleteBooks(Request $request, $handle)
    {
        $query = $request->input('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $library = Library::where('nm_handle', $handle)->first();

        if (!$library) {
            return response()->json([]);
        }

        $books = Book::with(['autor', 'assuntos', 'editora'])
            ->where('id_biblioteca', $library->id_biblioteca)
            ->where(function ($q) use ($query) {
                $q->where('nm_livro', 'LIKE', "%$query%")
                    ->orWhereHas('autor', function ($q) use ($query) {
                        $q->where('nm_autor', 'LIKE', "%$query%");
                    })
                    ->orWhereHas('assuntos', function ($q) use ($query) {
                        $q->where('nm_assunto', 'LIKE', "%$query%");
                    })
                    ->orWhereHas('editora', function ($q) use ($query) {
                        $q->where('nm_editora', 'LIKE', "%$query%");
                    });
            })
            ->limit(10)
            ->get();

        $results = $books->map(function ($book) {
            return [
                'title' => $book->nm_livro,
                'author' => $book->autor->nm_autor ?? 'Unknown',
                'publisher' => $book->editora->nm_editora ?? null,
                'subjects' => $book->assuntos->pluck('nm_assunto')->implode(', '),
                'id' => $book->id_livro
            ];
        });

        return response()->json($results);
    }

    public function showRules($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $isManager = Auth::check() ? DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $library->id_biblioteca)
            ->exists() : false;

        return view('rules', [
            'isManager' => $isManager,
            'library' => $library,
            'currentLibraryHandle' => $handle
        ]);
    }

    public function showBook(Book $book)
    {
        $book->load([
            'serieColecao',
            'autor',
            'editora',
            'idioma',
            'localPublicacao',
            'assuntos',
            'library',
            'emprestimosAtivos.usuario'
        ]);

        $isManager = Auth::user()->managerVerify($book->library->id_biblioteca);

        // Get available users for lending
        $usuarios = collect();
        if ($isManager && $book->fl_disponivel) {
            $library = $book->library;

            $usuariosComLimite = DB::table('tb_emprestimo')
                ->join('tb_livro', 'tb_emprestimo.id_livro', '=', 'tb_livro.id_livro')
                ->where('tb_livro.id_biblioteca', $library->id_biblioteca)
                ->where('tb_emprestimo.fl_devolvido', false)
                ->groupBy('tb_emprestimo.id_usuario')
                ->havingRaw('COUNT(*) >= ?', [$library->qt_limite_emprestimos])
                ->pluck('tb_emprestimo.id_usuario')
                ->toArray();

            $usuariosMembros = DB::table('tb_usuario_biblioteca')
                ->where('id_biblioteca', $library->id_biblioteca)
                ->pluck('id_usuario')
                ->toArray();

            $usuarios = User::whereIn('id', $usuariosMembros)
                ->whereNotIn('id', $usuariosComLimite)
                ->get();
        }

        return view('book-details', [
            'book' => $book,
            'library' => $book->library,
            'isManager' => $isManager,
            'usuarios' => $usuarios // Pass users to view
        ]);
    }

    public function showCollectionBooks($libraryHandle, $collectionId)
    {
        $library = Library::where('nm_handle', $libraryHandle)->firstOrFail();
        $collection = CollectionSeries::with(['livros.autor', 'livros.assuntos'])->findOrFail($collectionId);

        // Assuming you want all books from the collection for this library
        $books = $collection->livros->where('id_biblioteca', $library->id_biblioteca);

        // Check if current user is manager for UI controls
        $isManager = Auth::check() && Auth::user()->managerVerify($library->id_biblioteca);

        return view('collection-books', compact('library', 'collection', 'books', 'isManager'));
    }

    public function showAuthorBooks($libraryHandle, $authorId)
    {
        $library = Library::where('nm_handle', $libraryHandle)->firstOrFail();
        $author = Author::with([
            'livros' => function ($q) use ($library) {
                $q->where('id_biblioteca', $library->id_biblioteca)
                    ->with(['assuntos', 'serieColecao']); // Load relations if needed
            }
        ])->findOrFail($authorId);

        $books = $author->livros;

        $isManager = Auth::check() && Auth::user()->managerVerify($library->id_biblioteca);

        return view('author-books', compact('author', 'library', 'books', 'isManager'));
    }


    public function createBookForm($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $idiomas = DB::table('tb_idioma')->orderBy('nm_idioma')->get();
        return view('add-books', [
            'library' => $library,
            'currentLibraryHandle' => $handle,
            'idiomas' => $idiomas
        ]);
    }

    public function destroy($id_livro)
    {
        $book = Book::with('library')->findOrFail($id_livro);

        if (!$book->library) {
            abort(404, 'Associated library not found');
        }

        // Get library handle - prioritize form input, then relationship
        $libraryHandle = request('library_handle') ?? optional($book->library)->nm_handle;

        if (!$libraryHandle) {
            return redirect()->back()
                ->with('error', 'Este livro não está associado a nenhuma biblioteca');
        }

        DB::beginTransaction();

        try {
            DB::table('tb_livroassunto')->where('id_livro', $book->id_livro)->delete();
            DB::table('tb_emprestimo')->where('id_livro', $book->id_livro)->delete();
            $book->delete();

            DB::commit();

            return redirect()->route('library.books', ['library' => $libraryHandle])
                ->with('success', 'Livro excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao excluir livro: ' . $e->getMessage());
        }
    }

    public function edit(Book $book, Library $library)
    {
        // Check if user is manager of the book's library
        $isManager = DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $book->id_biblioteca)
            ->exists();

        $idiomas = Language::orderBy('nm_idioma')->get();
        $assuntos = $book->assuntos->pluck('nm_assunto')->toArray();

        return view('edit-book', [
            'book' => $book,
            'idiomas' => $idiomas,
            'assuntos' => $assuntos,
            'library' => $book->library
        ]);
    }

    public function toggleFix(Book $book)
    {
        $book->ds_fixado = !$book->ds_fixado;
        $book->dt_fixado = $book->ds_fixado ? now() : null;
        $book->save();

        return redirect()->back()->with('success', 'Livro atualizado com sucesso!');
    }

    public function update(Request $request, Book $book, CutterService $cutterService)
    {
        // Authorization check
        $isManager = DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $book->id_biblioteca)
            ->exists();

        if (!$isManager) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este livro.');
        }

        // Validation (same as store method)
        $validated = $request->validate([
            'nm_livro' => 'required|string|max:100',
            'ds_cdd' => 'required|string|max:15',
            'ds_isbn' => 'required|string|max:13',
            'nr_anoPublicacao' => 'nullable|integer',
            'dt_registro' => 'nullable|string|max:10',
            'id_idioma' => 'required|exists:tb_idioma,id_idioma',
            'nm_editora' => 'nullable|string|max:30',
            'nm_autor' => 'nullable|string|max:30',
            'nm_localPublicacao' => 'nullable|string|max:20',
            'nr_exemplar' => 'required|digits_between:1,4',
            'nm_serieColecao' => 'nullable|string|max:30',
            'nr_edicao' => 'nullable|string|max:2',
            'nr_volume' => 'nullable|string|max:2',
            'ds_observacao' => 'nullable|string|max:300',
            'ds_sinopse' => 'nullable|string|max:1500',
            'id_biblioteca' => 'required|string',
            'nm_assunto' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nm_livro.required' => 'O título é obrigatório.',
            'nm_livro.string' => 'O título deve ser um texto.',
            'nm_livro.max' => 'O título não pode ter mais que 50 caracteres.',

            'ds_cdd.max' => 'O CDD não pode ter mais que 15 caracteres.',

            'ds_isbn.max' => 'O ISBN não pode ter mais que 13 caracteres.',

            'nr_anoPublicacao.integer' => 'O ano de publicação deve ser um número.',

            'dt_registro.max' => 'O ID de registro não pode ter mais que 10 caracteres.',

            'id_idioma.required' => 'O idioma é obrigatório.',
            'id_idioma.exists' => 'O idioma selecionado é inválido.',

            'nm_editora.max' => 'A editora não pode ter mais que 30 caracteres.',

            'nm_autor.max' => 'O nome do autor não pode ter mais que 30 caracteres.',

            'nm_localPublicacao.max' => 'O local de publicação não pode ter mais que 20 caracteres.',

            'nr_exemplar.digits_between' => 'O número de exemplares não pode ter mais que 4 dígitos.',

            'nm_serieColecao.max' => 'A série/coleção não pode ter mais que 30 caracteres.',

            'ds_observacao.max' => 'A observação não pode ter mais que 300 caracteres.',

            'ds_sinopse.max' => 'A sinopse não pode ter mais que 1500 caracteres.',

            'id_biblioteca.required' => 'A biblioteca é obrigatória.',

            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png ou jpg.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ]);


        // Update the book (similar to store method logic)
        $editora = null;
        if ($request->nm_editora) {
            $editora = Publisher::firstOrCreate(['nm_editora' => $request->nm_editora]);
        }

        $autor = null;
        if ($request->nm_autor) {
            $autor = Author::firstOrCreate([
                'nm_autor' => $request->nm_autor
            ]);
        }

        $localPublicacao = null;
        if ($request->nm_localPublicacao) {
            $localPublicacao = PublicationPlace::firstOrCreate([
                'nm_localPublicacao' => $request->nm_localPublicacao
            ]);
        }

        $serieColecao = null;
        if ($request->nm_serieColecao) {
            $serieColecao = CollectionSeries::firstOrCreate([
                'nm_serieColecao' => $request->nm_serieColecao
            ]);
        }

        if ($request->nm_autor !== $book->autor->nm_autor || $request->nm_livro !== $book->nm_livro) {
            $cutter = $cutterService->generateCutter($request->nm_autor, $request->nm_livro);
        } else {
            $cutter = $book->ds_cutter;
        }

        $photoData = [];
        if ($request->has('remove_cover') && $book->photo_path) {
            // Delete the current image
            Storage::disk('public')->delete($book->photo_path);
            $photoData = [
                'photo_name' => null,
                'photo_size' => null,
                'photo_path' => null,
            ];
        }

        // Handle new image upload
        elseif ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->photo_path) {
                Storage::disk('public')->delete($book->photo_path);
            }

            $photoData = [
                'photo_name' => $request->file('image')->getClientOriginalName(),
                'photo_size' => $request->file('image')->getSize(),
                'photo_path' => $request->file('image')->store('images', 'public'),
            ];
        }

        $book->update(array_merge([
            'nm_livro' => $request->nm_livro,
            'ds_cutter' => $cutter,
            'ds_cdd' => $request->ds_cdd,
            'ds_isbn' => $request->ds_isbn,
            'nr_anoPublicacao' => $request->nr_anoPublicacao,
            'id_idioma' => $request->id_idioma,
            'id_editora' => $editora?->id_editora,
            'id_autor' => $autor?->id_autor,
            'id_localPublicacao' => $localPublicacao?->id_localPublicacao,
            'nr_exemplar' => $request->nr_exemplar,
            'id_serieColecao' => $serieColecao?->id_serieColecao,
            'nr_edicao' => $request->nr_edicao,
            'nr_volume' => $request->nr_volume,
            'ds_observacao' => $request->ds_observacao,
            'ds_sinopse' => $request->ds_sinopse,
        ], $photoData));

        $tags = json_decode($request->nm_assunto, true);
        if (!is_array($tags) || empty($tags)) {
            return back()->withErrors(['nm_assunto' => 'Insira pelo menos um assunto válido.']);
        }

        $assuntoIds = [];

        foreach ($tags as $tag) {
            $nome = trim($tag['value']);
            if ($nome === '')
                continue;
            $assunto = Subject::firstOrCreate(['nm_assunto' => $nome]);
            $assuntoIds[] = $assunto->id_assunto;
        }

        $book->assuntos()->sync($assuntoIds);


        return redirect()->route('book', $book)
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function create(Library $library)
    {
        $idiomas = Language::orderBy('nm_idioma')->get();
        return view('add-books', [
            'library' => $library,
            'idiomas' => $idiomas,
            'suggestedCutter' => '' // Inicialmente vazio, será preenchido via AJAX
        ]);
    }

    public function generateCutter(Request $request, CutterService $cutterService)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255'
        ]);

        $cutter = $cutterService->generateCutter($request->author, $request->title);

        return response()->json([
            'cutter' => $cutter
        ]);
    }

    public function store(Request $request, CutterService $cutterService, $handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $validated = $request->validate([
            'nm_livro' => 'required|string|max:100',
            'ds_cdd' => 'required|string|max:15',
            'ds_isbn' => 'required|string|max:13',
            'nr_anoPublicacao' => 'nullable|integer',
            'dt_registro' => 'nullable|string|max:10',
            'id_idioma' => 'required|exists:tb_idioma,id_idioma',
            'nm_editora' => 'nullable|string|max:30',
            'nm_autor' => 'nullable|string|max:30',
            'nm_localPublicacao' => 'nullable|string|max:20',
            'nr_exemplar' => 'required|digits_between:1,4',
            'nm_serieColecao' => 'nullable|string|max:30',
            'nr_edicao' => 'nullable|string|max:2',
            'nr_volume' => 'nullable|string|max:2',
            'ds_observacao' => 'nullable|string|max:300',
            'ds_sinopse' => 'nullable|string|max:1500',
            'id_biblioteca' => 'required|string',
            'nm_assunto' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nm_livro.required' => 'O título é obrigatório.',
            'nm_livro.string' => 'O título deve ser um texto.',
            'nm_livro.max' => 'O título não pode ter mais que 50 caracteres.',

            'ds_cdd.max' => 'O CDD não pode ter mais que 15 caracteres.',

            'ds_isbn.max' => 'O ISBN não pode ter mais que 13 caracteres.',

            'nr_anoPublicacao.integer' => 'O ano de publicação deve ser um número.',

            'dt_registro.max' => 'O ID de registro não pode ter mais que 10 caracteres.',

            'id_idioma.required' => 'O idioma é obrigatório.',
            'id_idioma.exists' => 'O idioma selecionado é inválido.',

            'nm_editora.max' => 'A editora não pode ter mais que 30 caracteres.',

            'nm_autor.max' => 'O nome do autor não pode ter mais que 30 caracteres.',

            'nm_localPublicacao.max' => 'O local de publicação não pode ter mais que 20 caracteres.',

            'nr_exemplar.digits_between' => 'O número de exemplares não pode ter mais que 4 dígitos.',

            'nm_serieColecao.max' => 'A série/coleção não pode ter mais que 30 caracteres.',

            'ds_observacao.max' => 'A observação não pode ter mais que 300 caracteres.',

            'ds_sinopse.max' => 'A sinopse não pode ter mais que 1500 caracteres.',

            'id_biblioteca.required' => 'A biblioteca é obrigatória.',

            'image.image' => 'O arquivo deve ser uma imagem válida.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png ou jpg.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ]);

        $cutter = $cutterService->generateCutter($request->nm_autor, $request->nm_livro);

        $editora = null;
        if ($request->nm_editora) {
            $editora = Publisher::firstOrCreate([
                'nm_editora' => $request->nm_editora
            ]);
        }

        $autor = null;
        if ($request->nm_autor) {
            $autor = Author::firstOrCreate([
                'nm_autor' => $request->nm_autor
            ]);
        }

        $localPublicacao = null;
        if ($request->nm_localPublicacao) {
            $localPublicacao = PublicationPlace::firstOrCreate([
                'nm_localPublicacao' => $request->nm_localPublicacao
            ]);
        }

        $serieColecao = null;
        if ($request->nm_serieColecao) {
            $serieColecao = CollectionSeries::firstOrCreate([
                'nm_serieColecao' => $request->nm_serieColecao
            ]);
        }

        $photoData = [];
        if ($request->hasFile('image')) {
            $photoData = [
                'photo_name' => $request->file('image')->getClientOriginalName(),
                'photo_size' => $request->file('image')->getSize(),
                'photo_path' => $request->file('image')->store('images', 'public'),
            ];
        }

        $livro = Book::create(array_merge([
            'nm_livro' => $request->nm_livro,
            'ds_cutter' => $cutter,
            'ds_cdd' => $request->ds_cdd,
            'ds_isbn' => $request->ds_isbn,
            'nr_anoPublicacao' => $request->nr_anoPublicacao,
            'dt_registro' => now(),
            'id_idioma' => $request->id_idioma,
            'id_editora' => $editora?->id_editora,
            'id_autor' => $autor?->id_autor,
            'id_localPublicacao' => $localPublicacao?->id_localPublicacao,
            'nr_exemplar' => $request->nr_exemplar,
            'id_serieColecao' => $serieColecao?->id_serieColecao,
            'nr_edicao' => $request->nr_edicao,
            'nr_volume' => $request->nr_volume,
            'ds_observacao' => $request->ds_observacao,
            'ds_sinopse' => $request->ds_sinopse,
            'id_biblioteca' => $library->id_biblioteca,
        ], $photoData));

        $tags = json_decode($request->nm_assunto, true);
        if (!is_array($tags) || empty($tags)) {
            return back()->withErrors(['nm_assunto' => 'Insira pelo menos um assunto válido.']);
        }

        $assuntoIds = [];

        foreach ($tags as $tag) {
            $nome = trim($tag['value']);
            if ($nome === '')
                continue;

            $assunto = Subject::firstOrCreate(['nm_assunto' => $nome]);
            $assuntoIds[] = $assunto->id_assunto;
        }

        $livro->assuntos()->sync($assuntoIds);

        return redirect()->route('library.books', ['library' => $library])->with('success', 'Livro cadastrado com sucesso!');
    }
}
