<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;


class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Puzzle::query();

        // Tri
        if ($request->has('tri')) {
            switch ($request->tri) {
                case 'nom':
                    $query->orderBy('nom', 'asc');
                    break;

                case 'prix_asc':
                    $query->orderBy('prix', 'asc');
                    break;

                case 'prix_desc':
                    $query->orderBy('prix', 'desc');
                    break;
            }
        } else {
            $query->latest(); // par défaut
        }

        $puzzles = $query->get();

        return view('puzzles.index', compact('puzzles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Categorie::all();

        return view('puzzles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'categorie_id.required' => 'Le champ catégorie est obligatoire.',
            'categorie_id.exists' => 'La catégorie sélectionnée est invalide.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('puzzles', 'public');
        }

        \App\Models\Puzzle::create($data);

        return redirect()->route('puzzles.index')->with('success', 'Puzzle créé avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupérer le puzzle en utilisant l'ID
        $puzzle = Puzzle::findOrFail($id);

        // Retourner la vue avec les données du puzzle
        return view('puzzles.show', compact('puzzle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $puzzle = \App\Models\Puzzle::findOrFail($id);
        $categories = \App\Models\Categorie::all();

        return view('puzzles.edit', compact('puzzle', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $puzzle = \App\Models\Puzzle::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'categorie_id.required' => 'Le champ catégorie est obligatoire.',
            'categorie_id.exists' => 'La catégorie sélectionnée est invalide.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('puzzles', 'public');
        }

        $puzzle->update($data);

        return redirect()->route('puzzles.index')->with('success', 'Puzzle mis à jour.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        $puzzle->delete();
        

        return redirect()
        ->route('puzzles.index')
        ->with('message', 'Le puzzle a bien été supprimé.');
    }
}
