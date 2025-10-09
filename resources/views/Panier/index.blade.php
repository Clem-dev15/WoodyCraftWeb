<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon panier') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                {{-- Message succès --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Message erreur --}}
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Tableau du panier --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @forelse($panier as $id => $item)
                                @php
                                    $sousTotal = $item['quantite'] * $item['prix'];
                                    $total += $sousTotal;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item['nom'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item['quantite'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($item['prix'], 2) }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($sousTotal, 2) }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 space-x-2">

                                        {{-- Supprimer une quantité spécifique --}}
                                        <form action="{{ route('panier.supprimer_quantite', $id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantite" value="1" min="1" max="{{ $item['quantite'] }}" class="w-16 border rounded px-2 py-1 text-sm" />
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-800 text-sm">
                                                Retirer
                                            </button>
                                        </form>

                                        {{-- Supprimer complètement le produit --}}
                                        <form action="{{ route('panier.supprimer', $id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Votre panier est vide.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Total général --}}
                <div class="mt-6 text-right">
                    <p class="text-lg font-semibold">
                        Total : {{ number_format($total, 2) }} €
                    </p>
                </div>

                {{-- Bouton Passer commande --}}
                @if(count($panier) > 0)
                <div class="mt-6 text-right">
                    <a href="{{ route('commandes.create') }}" class="inline-block bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-900">
                        Passer commande
                    </a>
                </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
