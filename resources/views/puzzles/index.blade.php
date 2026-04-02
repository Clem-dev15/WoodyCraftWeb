<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des puzzles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($puzzles as $puzzle)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $puzzle->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $puzzle->prix }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('panier.ajouter') }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $puzzle->id }}">
                                                <input type="hidden" name="nom" value="{{ $puzzle->nom }}">
                                                <input type="hidden" name="prix" value="{{ $puzzle->prix }}">

                                                {{-- Contrôle quantité --}}
                                                    <input type="number" 
                                                           name="quantite" 
                                                           value="1" 
                                                           min="1" 
                                                           class="w-16 text-center border-0 focus:ring-0">

                                                {{-- Bouton ajouter --}}
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-grey rounded-md hover:bg-indigo-500">
                                                    Ajouter
                                                </button>
                                                {{-- Bouton pour voir la description --}}
                                                <a href="{{ route('puzzles.show', $puzzle->id) }}" class="ml-4 text-blue-600 hover:text-blue-800">
                                                    Voir la description
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Nos Puzzles</h1>

<div class="grid grid-cols-3 gap-6">

@foreach($puzzles as $puzzle)
    <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">

        {{-- IMAGE --}}
        @if($puzzle->image)
            <img src="{{ asset('storage/' . $puzzle->image) }}" 
                 class="w-full h-48 object-cover mb-3 rounded">
        @endif

        {{-- NOM --}}
        <h2 class="font-bold text-lg">{{ $puzzle->nom }}</h2>

        {{-- PRIX --}}
        <p class="text-gray-600">{{ $puzzle->prix }} €</p>

        {{-- BOUTON VOIR --}}
        <a href="{{ route('puzzles.show', $puzzle->id) }}"
           class="block bg-blue-500 text-white text-center px-3 py-2 mt-3 rounded">
            Voir le produit
        </a>

    </div>
@endforeach

</div>

@endsection
