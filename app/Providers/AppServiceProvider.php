<?php

namespace App\Providers;

use App\Services\CutterService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Library;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cutter', function () {
            return new CutterService();
        });
    }

    public function boot()
    {
        View::composer(['home', 'discover', 'create-library', 'edit-library', 'settings', 'settings.update-name', 'settings.update-password', 'library-catalog'], function ($view) {
            $user = Auth::user();

            $bibliotecas = Library::whereIn('id_biblioteca', function ($query) use ($user) {
                $query->select('id_biblioteca')
                    ->from('tb_gestor_biblioteca')
                    ->where('id_usuario', $user->id);
            })->get();

            $todasBibliotecas = [];
            if ($view->name() === 'discover') {
                $searchQuery = request()->input('query');
                $todasBibliotecas = $searchQuery
                    ? $this->getSearchResults($searchQuery)
                    : Library::all();
            }

            $view->with([
                'bibliotecas' => $bibliotecas,
                'todasBibliotecas' => $todasBibliotecas ?? Library::all(),
                'searchQuery' => request()->input('query')
            ]);
        });

        View::composer('discover', function ($view) {});

        // View::composer('*', function ($view) {
        //     if (Auth::check()) {
        //         $library = Library::whereIn('id_biblioteca', function ($query) {
        //             $query->select('id_biblioteca')
        //                 ->from('tb_gestor_biblioteca')
        //                 ->where('id_usuario', Auth::id());
        //         })->first();

        //         $view->with('library', $library);
        //     }
        // });
    }

    protected function getSearchResults($query)
    {
        return Library::where('nm_biblioteca', 'LIKE', "%{$query}%")
            ->orWhere('nm_handle', 'LIKE', "%{$query}%")
            ->orWhere('ds_descricao', 'LIKE', "%{$query}%")
            ->get();
    }
}
