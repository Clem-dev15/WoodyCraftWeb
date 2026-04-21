@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Mon panier</h1>

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

    @if($panier->isEmpty())
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            Votre panier est vide.
        </div>
    @else
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">

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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->nom }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <input
                                            type="number"
                                            min="1"
                                            name="quantite[{{ $item->id }}]"
                                            value="{{ $item->quantite }}"
                                            class="w-16 border rounded px-2 py-1"
                                        >
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($item->prix, 2, ',', ' ') }} €
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($sousTotal, 2, ',', ' ') }} €
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                        <button
                                            type="submit"
                                            form="delete-item-{{ $item->id }}"
                                            class="text-red-600 hover:text-red-800 font-semibold"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');"
                                        >
                                            Supprimer
                                        </button>
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

            @foreach($panier as $item)
                <form
                    id="delete-item-{{ $item->id }}"
                    action="{{ route('panier.destroy', $item->id) }}"
                    method="POST"
                    class="hidden"
                >
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

            <div class="mt-6 text-right">
                <a href="{{ route('commandes.create') }}" class="inline-block px-6 py-3 bg-gray-800 text-white rounded hover:bg-gray-900">
                    Passer commande
                </a>
            </div>
        </div>
    @endif
@endsection