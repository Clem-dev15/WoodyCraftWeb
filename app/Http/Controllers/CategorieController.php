<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        // Récupère toutes les catégories
        $categories = Categorie::all();
          // Cette ligne récupère toutes les catégories

        // Passe la variable $categories à la vue 'categorie.index'
        return view('categorie.index', compact('categories'));  // Le problème pourrait venir ici
    }


    public function show(Categorie $categorie)
    {
        $puzzles = $categorie->puzzles;

        if (is_null($puzzles)){
            $puzzles = collect();
        }
        
        return view('categorie.show', compact('categorie', 'puzzles'));
    }
    
}
