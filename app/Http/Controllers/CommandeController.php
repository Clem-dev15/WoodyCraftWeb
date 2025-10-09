<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Assure-toi d'avoir barryvdh/laravel-dompdf installé pour la génération PDF
use Illuminate\Support\Facades\Session;

class CommandeController extends Controller
{
    // Affiche le formulaire de commande
    public function create()
    {
        $panier = session()->get('panier', []);
        return view('commandes.create', compact('panier'));
    }

    // Traite la commande
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'ville' => 'required|string|max:100',
            'departement' => 'required|string|max:5',
            'nom_rue' => 'required|string|max:255',
            'numero_rue' => 'required|string|max:10',
            'paiement' => 'required|in:cheque,paypal,carte',
            'numero_carte' => 'required_if:paiement,carte|nullable|string|size:19',
            'date_expiration' => 'required_if:paiement,carte|nullable|string|size:5',
            'cvv' => 'required_if:paiement,carte|nullable|string|size:3',
        ]);
        

        // Récupérer le panier depuis la session
        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        // Calcul du total
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        // Enregistrer la commande en base si besoin (à ajouter selon ta logique)

        // Selon le mode de paiement
        if ($validated['paiement'] === 'paypal') {
            // Redirection vers PayPal (URL d'exemple)
            return redirect('https://www.paypal.com/fr/home/');
        }

        // Paiement par chèque : générer et télécharger PDF
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
        session()->forget('panier');

        return $pdf->download('facture.pdf');
    }
}
