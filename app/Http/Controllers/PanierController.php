<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;

class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier', []);
        return view('panier.index', compact('panier'));
    }

    public function ajouter(Request $request)
    {
        $produitId = $request->input('id');
        $nom = $request->input('nom');
        $prix = $request->input('prix');
        $quantite = (int) $request->input('quantite', 1);

        $panier = session()->get('panier', []);

        if (isset($panier[$produitId])) {
            $panier[$produitId]['quantite'] += $quantite;
        } else {
            $panier[$produitId] = [
                "nom" => $nom,
                "quantite" => $quantite,
                "prix" => $prix
            ];
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'Produit ajouté au panier !');
    }
    
    public function ajouterAuPanier($puzzle_id)
    {
        $puzzle = Puzzle::findOrFail($puzzle_id);

        Panier::create([
            'puzzle_id' => $puzzle->id,
            'nom' => $puzzle->nom,
            'prix' => $puzzle->prix,
        ]);

        return redirect()->route('panier.index')->with('success', 'Puzzle ajouté au panier');
    }


    public function destroy($id)
    {
        $article = Panier::findOrFail($id);
        $article->delete();

        return redirect()->route('panier.index')->with('success', 'Article supprimé avec succès');
    }

}
