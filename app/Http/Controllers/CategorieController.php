<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        // Récupère toutes les catégories
        $categories = Categorie::with('puzzles')->get();
          // Cette ligne récupère toutes les catégories

        // Passe la variable $categories à la vue 'categorie.index'
        return view('categories.index', compact('categories'));  // Le problème pourrait venir ici
    }


    public function show(Categorie $categorie)
    {
        // Charge la relation puzzles pour la catégorie sélectionnée
        $categorie->load('puzzles');

        return view('categories.show', compact('categorie'));
    }
}
