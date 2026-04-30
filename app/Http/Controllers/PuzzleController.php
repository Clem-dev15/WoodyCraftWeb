<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        return view('puzzles.create', compact('categories', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'prix' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('puzzles', 'public');
        }

        Puzzle::create($validated);

        return redirect()
            ->route('puzzles.index')
            ->with('message', 'Puzzle créé avec succès.');
    }

    public function show(Puzzle $puzzle)
    {
        $puzzle->load(['categorie', 'fournisseur']);

        return view('puzzles.show', compact('puzzle'));
    }

    public function edit(Puzzle $puzzle)
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        return view('puzzles.edit', compact('puzzle', 'categories', 'fournisseurs'));
    }

    public function update(Request $request, Puzzle $puzzle)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'prix' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($puzzle->image) {
                Storage::disk('public')->delete($puzzle->image);
            }

            $validated['image'] = $request->file('image')->store('puzzles', 'public');
        }

        $puzzle->update($validated);

        return redirect()
            ->route('puzzles.index')
            ->with('message', 'Puzzle mis à jour avec succès.');
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
