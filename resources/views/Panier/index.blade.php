@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Mon panier</h1>

{{-- Messages --}}
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
    <p>Votre panier est vide.</p>
@else

<form action="{{ route('panier.updateQuantite') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Produit</th>
                    <th class="px-6 py-3">Quantité</th>
                    <th class="px-6 py-3">Prix</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @php $total = 0; @endphp

                @foreach($panier as $item)
                    @php 
                        $sousTotal = $item->prix * $item->quantite; 
                        $total += $sousTotal;
                    @endphp

                    <tr class="border-t">

                        <td class="px-6 py-4">{{ $item->nom }}</td>

                        <td class="px-6 py-4">
                            <input type="number"
                                   name="quantite[{{ $item->id }}]"
                                   value="{{ $item->quantite }}"
                                   min="1"
                                   class="w-16 border rounded px-2 py-1">
                        </td>

                        <td class="px-6 py-4">{{ number_format($item->prix, 2) }} €</td>

                        <td class="px-6 py-4">{{ number_format($sousTotal, 2) }} €</td>

                        <td class="px-6 py-4 text-center">

                            {{-- Bouton supprimer séparé --}}
                            <form action="{{ route('panier.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Supprimer cet article ?')">

                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 hover:text-red-800">
                                    Supprimer
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    {{-- Footer --}}
    <div class="mt-6 flex justify-between items-center">

        <button type="submit"
                class="px-4 py-2 bg-gray-800 text-white rounded">
            Mettre à jour
        </button>

        <div class="text-lg font-semibold">
            Total : {{ number_format($total, 2, ',', ' ') }} €
        </div>

    </div>

</form>

<div class="mt-6 text-right">
    <a href="{{ route('commandes.create') }}"
       class="px-6 py-3 bg-green-600 text-white rounded">
        Passer commande
    </a>
</div>

@endif

@endsection