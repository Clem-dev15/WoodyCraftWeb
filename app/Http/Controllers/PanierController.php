<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Puzzle;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $panier = Panier::where('user_id', $userId)->get();

        return view('panier.index', compact('panier'));
    }

    public function ajouter(Request $request)
    {
        $userId = $request->user()->id;
        $puzzleId = $request->input('id');
        $quantite = (int) $request->input('quantite', 1);

        $puzzle = Puzzle::findOrFail($puzzleId);

        $item = Panier::where('user_id', $userId)
                      ->where('puzzle_id', $puzzleId)
                      ->first();

        if ($item) {
            // Si déjà dans le panier, on augmente la quantité
            $item->quantite += $quantite;
            $item->save();
        } else {
            // Sinon on crée une nouvelle ligne
            Panier::create([
                'user_id' => $userId,
                'puzzle_id' => $puzzle->id,
                'nom' => $puzzle->nom,
                'quantite' => $quantite,
                'prix' => $puzzle->prix,
            ]);
        }

        return redirect()->route('panier.index')->with('success', 'Produit ajouté au panier !');
    }

    public function updateQuantite(Request $request)
    {
        $userId = $request->user()->id;
        $quantites = $request->input('quantite');

        // Validation des quantités
        $validated = $request->validate([
            'quantite.*' => 'required|integer|min:1',
        ]);

        foreach ($quantites as $id => $quantite) {
            $item = Panier::where('id', $id)
                        ->where('user_id', $userId)
                        ->firstOrFail();

            // Mise à jour de la quantité ou suppression
            if ($quantite > 0) {
                $item->quantite = $quantite;
                $item->save();
            } else {
                $item->delete();
            }
        }

        return redirect()->route('panier.index')->with('success', 'Quantités mises à jour.');
    }


    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        $item = Panier::where('id', $id)
                    ->where('user_id', $userId)
                    ->firstOrFail();

        $item->delete();

        return redirect()->route('panier.index')->with('success', 'Article supprimé avec succès');
    }

}
