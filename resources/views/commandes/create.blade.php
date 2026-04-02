@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Validation de la commande</h1>

<form method="POST" action="{{ route('commandes.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Ville</label>
        <input type="text" name="ville" class="w-full border p-2" required>
    </div>

    <div>
        <label>Département</label>
        <input type="text" name="departement" class="w-full border p-2" required>
    </div>

    <div>
        <label>Rue</label>
        <input type="text" name="nom_rue" class="w-full border p-2" required>
    </div>

    <div>
        <label>Numéro</label>
        <input type="text" name="numero_rue" class="w-full border p-2" required>
    </div>

    <div>
        <label>Paiement</label>
        <select name="paiement" class="w-full border p-2">
            <option value="cheque">Chèque</option>
            <option value="paypal">PayPal</option>
            <option value="carte">Carte</option>
        </select>
    </div>

    <button class="bg-green-600 text-white px-6 py-3 rounded">
        Valider la commande
    </button>

</form>

@endsection