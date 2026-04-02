@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Catégorie : {{ $categorie->nom }}
</h1>

@if($categorie->puzzles->isEmpty())
    <p>Aucun puzzle dans cette catégorie.</p>
@else

<div class="grid grid-cols-3 gap-6">

    @foreach($categorie->puzzles as $puzzle)
        <div class="bg-white p-4 rounded shadow">

            <h2 class="font-bold">{{ $puzzle->nom }}</h2>

            <p class="text-gray-600">
                {{ $puzzle->prix }} €
            </p>

            <a href="{{ route('puzzles.show', $puzzle->id) }}"
               class="block mt-3 bg-blue-500 text-white text-center px-3 py-2 rounded">
                Voir
            </a>

        </div>
    @endforeach

</div>

@endif

@endsection