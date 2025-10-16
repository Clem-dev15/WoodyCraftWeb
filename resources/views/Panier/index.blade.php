<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon panier') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Message succès --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-600 text-white rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
            @if($panier->isEmpty())
                <p>Votre panier est vide.</p>
            @else
            <form action="{{ route('panier.updateQuantite') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $total = 0; @endphp
                                @foreach($panier as $item)
                                    @php 
                                        $sousTotal = $item->prix * $item->quantite; 
                                        $total += $sousTotal;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="number" min="1" name="quantite[{{ $item->id }}]" value="{{ $item->quantite }}" class="w-16 border rounded px-2 py-1" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->prix, 2) }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($sousTotal, 2) }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                            <form action="{{ route('panier.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                            Mettre à jour les quantités
                        </button>

                        <div class="text-lg font-semibold">
                            Total : {{ number_format($total, 2, ',', ' ') }} €
                        </div>
                    </div>
                </form>

                <div class="mt-6 text-right">
                    <a href="{{ route('commandes.create') }}" class="inline-block px-6 py-3 bg-gray-800 text-white rounded hover:bg-gray-900">
                        Passer commande
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
