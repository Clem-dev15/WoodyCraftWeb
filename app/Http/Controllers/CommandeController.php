<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdresseLivraison;
use App\Models\Panier;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{
    public function create()
    {
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

            'numero_carte' => 'required_if:paiement,carte|nullable|digits:16',
            'date_expiration' => 'required_if:paiement,carte|nullable|string|size:5',
            'cvv' => 'required_if:paiement,carte|nullable|digits:3',
        ], [
            'numero_carte.required_if' => 'Le numéro de carte est obligatoire pour un paiement par carte.',
            'numero_carte.digits' => 'Le numéro de carte doit contenir exactement 16 chiffres.',
            'date_expiration.required_if' => 'La date d’expiration est obligatoire pour un paiement par carte.',
            'date_expiration.size' => 'La date d’expiration doit être au format MM/AA.',
            'cvv.required_if' => 'Le CVV est obligatoire pour un paiement par carte.',
            'cvv.digits' => 'Le CVV doit contenir exactement 3 chiffres.',
        ]);

        $userId = auth()->id();

        AdresseLivraison::create([
            'user_id' => $userId,
            'ville' => $validated['ville'],
            'departement' => $validated['departement'],
            'nom_rue' => $validated['nom_rue'],
            'numero_rue' => $validated['numero_rue'],
        ]);

        $panier = Panier::where('user_id', $userId)->get();

        if ($panier->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($panier as $item) {
            $total += $item->prix * $item->quantite;
        }

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

            $pdf = Pdf::loadView('commandes.facture', $data);

            Panier::where('user_id', $userId)->delete();

            return $pdf->download('facture.pdf');
        }

        if ($validated['paiement'] === 'carte') {
            Panier::where('user_id', $userId)->delete();

            return redirect()->route('dashboard')->with('success', 'Commande validée et paiement par carte effectué.');
        }

        return redirect()->route('dashboard')->with('success', 'Commande validée.');
    }
}