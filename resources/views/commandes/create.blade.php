<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Passer une commande') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">

            {{-- Résumé du panier --}}
            <h3 class="text-lg font-semibold mb-4">Résumé de votre commande</h3>

            @if(count($panier) === 0)
                <p>Votre panier est vide.</p>
            @else
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200 mb-6">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($panier as $item)
                            @php
                                $sousTotal = $item['prix'] * $item['quantite'];
                                $total += $sousTotal;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $item['nom'] }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $item['quantite'] }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($item['prix'], 2) }} €</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($sousTotal, 2) }} €</td>
                            </tr>
                        @endforeach
                        <tr class="font-semibold border-t border-gray-300">
                            <td colspan="3" class="px-4 py-2 text-right text-gray-900">Total général :</td>
                            <td class="px-4 py-2 text-gray-900">{{ number_format($total, 2) }} €</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            {{-- Formulaire de commande --}}
            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf

                {{-- Ville --}}
                <div class="mb-4">
                    <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville') }}" required
                           class="w-full border rounded px-3 py-2 @error('ville') border-red-500 @enderror" />
                    @error('ville')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Numéro du département --}}
                <div class="mb-4">
                    <label for="departement" class="block text-gray-700 font-medium mb-2">Numéro du département</label>
                    <input type="text" id="departement" name="departement" value="{{ old('departement') }}" required
                           class="w-full border rounded px-3 py-2 @error('departement') border-red-500 @enderror" />
                    @error('departement')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nom de la rue --}}
                <div class="mb-4">
                    <label for="nom_rue" class="block text-gray-700 font-medium mb-2">Nom de la rue</label>
                    <input type="text" id="nom_rue" name="nom_rue" value="{{ old('nom_rue') }}" required
                           class="w-full border rounded px-3 py-2 @error('nom_rue') border-red-500 @enderror" />
                    @error('nom_rue')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Numéro de la rue --}}
                <div class="mb-6">
                    <label for="numero_rue" class="block text-gray-700 font-medium mb-2">Numéro de la rue</label>
                    <input type="text" id="numero_rue" name="numero_rue" value="{{ old('numero_rue') }}" required
                           class="w-full border rounded px-3 py-2 @error('numero_rue') border-red-500 @enderror" />
                    @error('numero_rue')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mode de paiement --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Mode de paiement</label>

                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="paiement" value="cheque" {{ old('paiement') === 'cheque' ? 'checked' : '' }} required>
                            <span class="ml-2">Chèque</span>
                        </label>

                        <label class="inline-flex items-center mr-6">
                            <input type="radio" name="paiement" value="paypal" {{ old('paiement') === 'paypal' ? 'checked' : '' }}>
                            <span class="ml-2">PayPal</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" name="paiement" value="carte" id="paiement_carte" {{ old('paiement') === 'carte' ? 'checked' : '' }}>
                            <span class="ml-2">Carte bancaire</span>
                        </label>

                        @error('paiement')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Formulaire carte bancaire (initialement caché) --}}
                    <div id="form-carte" class="mb-6" style="display: none;">
                        <h4 class="text-gray-700 font-semibold mb-2">Informations carte bancaire</h4>

                        <div class="mb-3">
                            <label for="numero_carte" class="block text-gray-700 mb-1">Numéro de carte</label>
                            <input type="text" name="numero_carte" id="numero_carte" maxlength="19" placeholder="1234 5678 9012 3456"
                                class="w-full border rounded px-3 py-2 @error('numero_carte') border-red-500 @enderror"
                                value="{{ old('numero_carte') }}">
                            @error('numero_carte')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_expiration" class="block text-gray-700 mb-1">Date d'expiration (MM/AA)</label>
                            <input type="text" name="date_expiration" id="date_expiration" maxlength="5" placeholder="MM/AA"
                                class="w-full border rounded px-3 py-2 @error('date_expiration') border-red-500 @enderror"
                                value="{{ old('date_expiration') }}">
                            @error('date_expiration')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cvv" class="block text-gray-700 mb-1">CVV</label>
                            <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="123"
                                class="w-full border rounded px-3 py-2 @error('cvv') border-red-500 @enderror"
                                value="{{ old('cvv') }}">
                            @error('cvv')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">
                    Valider la commande
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
