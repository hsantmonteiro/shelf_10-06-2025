<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LibrarySearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Models\CollectionSeries;


// Public routes (no authentication required)
Route::view('/', 'index');
Route::view('/about', 'about');
Route::view('/prices', 'prices');

// Authentication routes (login/register)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email verification routes
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::post('/email/verify', [VerificationController::class, 'verify'])
    ->middleware('auth')
    ->name('verification.verify');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware('auth')
    ->name('verification.resend');

Route::post('/email/verify/cancel', [VerificationController::class, 'cancel'])
    ->name('verification.cancel');

// Routes that require BOTH authentication AND email verification
Route::middleware(['auth', 'verified'])->group(function () {

    // Main application routes
    Route::view('/home', 'home')->name('home');
    Route::view('/discover', 'discover');
    Route::view('/rules', 'rules');
    Route::view('/catalog', 'library-catalog');

    Route::put('/loans/{id_emprestimo}/devolute', [LoanController::class, 'devolute'])
        ->name('loan.devolute');


    Route::post('/books/{book}/lend', [LoanController::class, 'lend'])->name('books.lend');

    // Library routes
    Route::get('/create-library', fn() => view('create-library'));
    Route::post('/create-library', [LibraryController::class, 'createLibrary']);

    Route::post('/join-library/{id}', [LibraryController::class, 'joinLibrary'])
        ->name('library.join');
    Route::post('/leave-library/{id}', [LibraryController::class, 'leaveLibrary'])
        ->name('library.leave');

    Route::post('/{library}/delete', [LibraryController::class, 'deleteLibrary'])
        ->name('library.delete');
    Route::get('/{library}/edit', [LibraryController::class, 'editLibrary'])
        ->name('library.edit');
    Route::post('/{library}/update', [LibraryController::class, 'updateLibrary'])
        ->name('library.update');

    Route::get('/{handle}/autocomplete-books', [LibraryController::class, 'autocompleteBooks'])
        ->name('books.autocomplete');

    Route::post('/generate-cutter', [LibraryController::class, 'generateCutter']);

    Route::prefix('/{library:nm_handle}')->group(function () {
        Route::get('/books', [LibraryController::class, 'showCatalog'])
            ->name('library.books');
        Route::get('/devolutions', [LoanController::class, 'showDevolutionTable'])
            ->name('library.devolutions');
        Route::get('/statistics', [DashboardController::class, 'showLibraryData'])
            ->name('library.statistics');
        Route::get('/rules', [LibraryController::class, 'showRules'])
            ->name('library.rules');
    });

    Route::post('/{library}/books', [LibraryController::class, 'store'])
        ->name('books.store')
        ->where('library', '[a-zA-Z0-9_.-]+');

    // Library books routes
    Route::prefix('/books')->group(function () {
        Route::delete('/{book}', [LibraryController::class, 'destroy'])
            ->name('books.destroy');
        Route::get('/{book}/edit', [LibraryController::class, 'edit'])
            ->name('books.edit');
        Route::put('/{book}', [LibraryController::class, 'update'])
            ->name('books.update');
        Route::get('/{book}', [LibraryController::class, 'showBook'])
            ->name('book');
        Route::post('/{book}/toggle-fix', [LibraryController::class, 'toggleFix'])
            ->name('books.toggleFix');
    });


    Route::get('/{library:nm_handle}/collections/{collection}', [LibraryController::class, 'showCollectionBooks'])
        ->name('library.collection.books');
    Route::get('{library}/authors/{author}', [LibraryController::class, 'showAuthorBooks'])
        ->name('library.authors.books');


    // Relatórios
    Route::get('/relatorios/{handle}/mais-emprestados', [DashboardController::class, 'makeBooksReport'])
        ->name('report.most-loaned-books');

    Route::get('/relatorios/{handle}/membros-ativos', [DashboardController::class, 'makeUsersReport'])
        ->name('report.top-members');

    Route::get('/relatorios/{handle}/emprestimos-no-mes', [DashboardController::class, 'makeLoansReport'])
        ->name('report.loansPerMonth');

    Route::get('/relatorios/{handle}/livros-no-mes', [DashboardController::class, 'makeStoreReport'])
        ->name('report.booksPerMonth');


    // Library search
    Route::get('/search-libraries', [LibrarySearchController::class, 'search'])
        ->name('library.search');
    Route::get('/autocomplete-libraries', [LibrarySearchController::class, 'autocomplete'])
        ->name('library.autocomplete');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
    Route::post('/settings/update-name', [ProfileController::class, 'updateName'])->name('settings.update-name.post');
    Route::post('/settings/update-picture', [ProfileController::class, 'updatePicture'])->name('settings.update-picture.post');
    Route::post('/settings/update-password', [ProfileController::class, 'updatePassword'])->name('settings.update-password.post');
});
