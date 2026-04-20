<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Puzzle;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('puzzles')->get();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        $puzzles = Puzzle::where('categorie_id', $id)->get();

        return view('categories.show', compact('categorie', 'puzzles'));
    }
}