@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- IMAGE PRODUIT --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="w-full h-[420px] bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                @if(!empty($puzzle->image))
                    <img src="{{ asset('storage/' . $puzzle->image) }}"
                         alt="{{ $puzzle->nom }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400 text-sm">Aucune image disponible</span>
                @endif
            </div>
        </div>

        {{-- INFOS PRODUIT --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <p class="text-sm uppercase tracking-wide text-gray-500 mb-2">
                Produit WoodyCraft
            </p>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                {{ $puzzle->nom }}
            </h1>

            @if(!empty($puzzle->categorie) && !empty($puzzle->categorie->nom))
                <p class="text-sm text-gray-600 mb-4">
                    Catégorie :
                    <span class="font-medium text-gray-800">{{ $puzzle->categorie->nom }}</span>
                </p>
            @endif

            <p class="text-4xl font-extrabold text-gray-900 mb-6">
                {{ number_format($puzzle->prix, 2, ',', ' ') }} €
            </p>

            <div class="border-t border-b border-gray-200 py-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $puzzle->description ?: 'Aucune description disponible pour ce puzzle.' }}
                </p>
            </div>

            <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-gray-700">
                    <span class="mr-2">✔</span>
                    Produit soigneusement sélectionné
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <span class="mr-2">✔</span>
                    Livraison rapide selon disponibilité
                </div>
                <div class="flex items-center text-sm text-gray-700">
                    <span class="mr-2">✔</span>
                    Achat simple et sécurisé
                </div>
            </div>

            <form action="{{ route('panier.ajouter') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="id" value="{{ $puzzle->id }}">

                <button type="submit"
                        class="w-full px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-lg hover:bg-yellow-300 transition">
                    Ajouter au panier
                </button>
            </form>

            <div class="mt-6">
            <a href="{{ url()->previous() }}"
            class="inline-block text-sm text-blue-600 hover:underline">
                ← Retour
            </a>
        </div>
    </div>

    {{-- BLOC COMPLÉMENTAIRE --}}
    <div class="mt-10 bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Pourquoi choisir ce puzzle ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Design soigné</h3>
                <p class="text-sm text-gray-600">
                    Chaque puzzle WoodyCraft est pensé pour offrir une présentation élégante et agréable.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Expérience ludique</h3>
                <p class="text-sm text-gray-600">
                    Un produit idéal pour se détendre, offrir ou enrichir une collection personnelle.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Navigation simple</h3>
                <p class="text-sm text-gray-600">
                    Retrouvez rapidement vos produits favoris et ajoutez-les au panier en un clic.
                </p>
            </div>
        </div>
    </div>
@endsection