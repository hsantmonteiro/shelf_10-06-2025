<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibrarySearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return redirect()->route('discover');
        }
        
        $results = Library::where('nm_biblioteca', 'LIKE', "%{$query}%")
                         ->orWhere('nm_handle', 'LIKE', "%{$query}%")
                         ->orWhere('ds_descricao', 'LIKE', "%{$query}%")
                         ->get();
        
        return view('discover', [
            'searchResults' => $results,
            'searchQuery' => $query,
            'todasBibliotecas' => $results // Override the default collection
        ]);
    }
    
    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        
        $results = Library::where('nm_biblioteca', 'LIKE', "%{$query}%")
                         ->orWhere('nm_handle', 'LIKE', "%{$query}%")
                         ->limit(5)
                         ->get(['id_biblioteca', 'nm_biblioteca', 'nm_handle']);
        
        return response()->json($results);
    }
}