<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Si tu utilises barryvdh/laravel-dompdf
use App\Models\AdresseLivraison;
use App\Models\Panier;

class CommandeController extends Controller
{
    public function create()
    {
        // Récupérer le panier utilisateur depuis la BDD
        $userId = auth()->id();
        $panier = Panier::where('user_id', $userId)->get();

        if ($panier->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        return view('commandes.create', compact('panier'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ville' => 'required|string|max:100',
            'departement' => 'required|string|max:5',
            'nom_rue' => 'required|string|max:255',
            'numero_rue' => 'required|string|max:10',
            'paiement' => 'required|in:cheque,paypal,carte',
            'numero_carte' => 'required_if:paiement,carte|nullable|string|size:19',
            'date_expiration' => 'required_if:paiement,carte|nullable|string|size:5',
            'cvv' => 'required_if:paiement,carte|nullable|string|size:3',
        ]);

        $userId = auth()->id();

        // Enregistrer l'adresse de livraison
        AdresseLivraison::create([
            'user_id' => $userId,
            'ville' => $validated['ville'],
            'departement' => $validated['departement'],
            'nom_rue' => $validated['nom_rue'],
            'numero_rue' => $validated['numero_rue'],
        ]);

        // Récupérer le panier en base
        $panier = Panier::where('user_id', $userId)->get();

        if ($panier->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        // Calcul du total
        $total = 0;
        foreach ($panier as $item) {
            $total += $item->prix * $item->quantite;
        }

        // Gestion du paiement
        if ($validated['paiement'] === 'paypal') {
            return redirect('https://www.paypal.com/fr/home/');
        }

        if ($validated['paiement'] === 'cheque') {
            $data = [
                'panier' => $panier,
                'total' => $total,
                'adresse' => [
                    'ville' => $validated['ville'],
                    'departement' => $validated['departement'],
                    'nom_rue' => $validated['nom_rue'],
                    'numero_rue' => $validated['numero_rue'],
                ],
            ];

            $pdf = PDF::loadView('commandes.facture', $data);

            // Vider le panier après commande
            Panier::where('user_id', $userId)->delete();

            return $pdf->download('facture.pdf');
        }

        if ($validated['paiement'] === 'carte') {
            // Ici tu pourrais intégrer la logique de paiement CB (Stripe, etc)
            // Pour l’instant on redirige simplement vers panier avec message

            // Vider le panier
            Panier::where('user_id', $userId)->delete();

            return redirect()->route('panier.index')->with('success', 'Commande validée et paiement par carte effectué !');
        }

        // Par défaut, retour panier
        return redirect()->route('panier.index')->with('success', 'Commande validée !');
    }
}
