@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Catégories</h1>

@if($categories->isEmpty())
    <p>Aucune catégorie.</p>
@else
    <div class="space-y-6">
        @foreach ($categories as $categorie)
            <div class="bg-white rounded shadow p-4">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-lg font-semibold">{{ $categorie->nom }}</h2>

                    <a href="{{ route('categories.show', $categorie->id) }}"
                       class="px-3 py-2 bg-gray-800 text-white rounded">
                        Voir
                    </a>
                </div>

                @if ($categorie->puzzles->isEmpty())
                    <p class="text-gray-500">Aucun puzzle pour cette catégorie.</p>
                @else
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        @foreach ($categorie->puzzles as $puzzle)
                            <li>{{ $puzzle->nom }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
@endif

@endsection