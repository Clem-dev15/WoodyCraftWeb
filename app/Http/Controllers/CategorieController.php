<?php

namespace App\Http\Controllers;

use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('puzzles')->get();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $categorie = \App\Models\Categorie::with('puzzles')->findOrFail($id);

        return view('categories.show', compact('categorie'));
    }
}