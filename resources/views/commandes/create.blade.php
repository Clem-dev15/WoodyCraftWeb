<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Passer une commande') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('commandes.store') }}">
                @csrf

                {{-- Adresse de livraison --}}
                <h3 class="text-lg font-semibold mb-4">Adresse de livraison</h3>

                <div class="mb-4">
                    <label for="ville" class="block font-medium text-gray-700">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="departement" class="block font-medium text-gray-700">Numéro du département</label>
                    <input type="text" id="departement" name="departement" maxlength="5" value="{{ old('departement') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="nom_rue" class="block font-medium text-gray-700">Nom de la rue</label>
                    <input type="text" id="nom_rue" name="nom_rue" value="{{ old('nom_rue') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="numero_rue" class="block font-medium text-gray-700">Numéro de la rue</label>
                    <input type="text" id="numero_rue" name="numero_rue" maxlength="10" value="{{ old('numero_rue') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Choix du mode de paiement --}}
                <h3 class="text-lg font-semibold mb-4">Mode de paiement</h3>

                <select id="paiement" name="paiement" required
                    class="mb-6 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">-- Choisissez un mode de paiement --</option>
                    <option value="cheque" {{ old('paiement') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                    <option value="paypal" {{ old('paiement') == 'paypal' ? 'selected' : '' }}>Paypal</option>
                    <option value="carte" {{ old('paiement') == 'carte' ? 'selected' : '' }}>Carte bancaire</option>
                </select>

                {{-- Formulaire carte bancaire (initialement caché) --}}
                <div id="form-cb" style="display: none;" class="mb-6 border p-4 rounded-md bg-gray-50">
                    <h4 class="font-semibold mb-3">Informations carte bancaire</h4>

                    <div class="mb-4">
                        <label for="numero_carte" class="block font-medium text-gray-700">Numéro de carte</label>
                        <input type="text" id="numero_carte" name="numero_carte" maxlength="19" value="{{ old('numero_carte') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="1234 5678 9012 3456">
                    </div>

                    <div class="mb-4">
                        <label for="date_expiration" class="block font-medium text-gray-700">Date d'expiration (MM/AA)</label>
                        <input type="text" id="date_expiration" name="date_expiration" maxlength="5" value="{{ old('date_expiration') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="04/26">
                    </div>

                    <div>
                        <label for="cvv" class="block font-medium text-gray-700">CVV</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" value="{{ old('cvv') }}"
                            class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="123">
                    </div>
                </div>

                {{-- Résumé de la commande --}}
                <h3 class="text-lg font-semibold mb-4">Résumé de la commande</h3>

                <table class="min-w-full table-auto mb-6 border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $total = 0; @endphp
                        @foreach ($panier as $item)
                            @php
                                $sousTotal = $item->prix * $item->quantite;
                                $total += $sousTotal;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $item->nom }}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $item->quantite }}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->prix, 2, ',', ' ') }} €</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ number_format($sousTotal, 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right font-semibold text-lg mb-6">
                    Total : {{ number_format($total, 2, ',', ' ') }} €
                </div>

                <button type="submit"
                    class="px-6 py-2 bg-gray-800 text-white font-semibold rounded hover:bg-gray-900 transition">
                    Valider la commande
                </button>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleFormCB() {
                var paiement = document.getElementById('paiement').value;
                var formCb = document.getElementById('form-cb');
                if (paiement === 'carte') {
                    formCb.style.display = 'block';
                } else {
                    formCb.style.display = 'none';
                }
            }

            // Afficher ou cacher le formulaire CB au chargement si valeur déjà choisie
            toggleFormCB();

            document.getElementById('paiement').addEventListener('change', toggleFormCB);
        });
    </script>
</x-app-layout>
