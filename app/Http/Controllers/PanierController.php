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


    public function supprimer($id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.index')->with('success', 'Produit supprimé du panier.');
    }

    public function retirerQuantite(Request $request, $id)
    {
        $quantiteARetirer = (int) $request->input('quantite', 1);

        $panier = session()->get('panier', []);

        if (!isset($panier[$id])) {
            return redirect()->route('panier.index')->with('error', 'Produit introuvable dans le panier.');
        }

        if ($quantiteARetirer >= $panier[$id]['quantite']) {
            // Supprimer complètement si la quantité demandée est supérieure ou égale
            unset($panier[$id]);
        } else {
            // Sinon on diminue simplement
            $panier[$id]['quantite'] -= $quantiteARetirer;
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.index')->with('success', 'Quantité mise à jour.');
    }



}
