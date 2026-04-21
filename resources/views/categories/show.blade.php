@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <section>
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-900">
                    Catégorie : {{ $categorie->nom }}
                </h1>

                <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">
                    Retour à l’accueil
                </a>
            </div>

            @if($puzzles->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <p class="text-gray-600">Aucun puzzle dans cette catégorie.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                    @foreach($puzzles as $puzzle)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                            <div class="h-48 bg-gray-100 flex items-center justify-center">
                                @if(!empty($puzzle->image))
                                    <img src="{{ asset('storage/' . $puzzle->image) }}"
                                         alt="{{ $puzzle->nom }}"
                                         class="h-full w-full object-cover">
                                @else
                                    <span class="text-gray-400 text-sm">Aucune image</span>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $puzzle->nom }}
                                </h3>

                                <p class="text-sm text-gray-600 mb-4 h-10 overflow-hidden">
                                    {{ $puzzle->description ?? 'Puzzle WoodyCraft de qualité.' }}
                                </p>

                                <p class="text-2xl font-bold text-gray-900 mb-4">
                                    {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                                </p>

                                <div class="flex gap-2">
                                    <a href="{{ route('puzzles.show', $puzzle->id) }}"
                                       class="flex-1 text-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                                        Voir
                                    </a>

                                    <form action="{{ route('panier.ajouter') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $puzzle->id }}">

                                        <button type="submit"
                                                class="w-full px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-300">
                                            Panier
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection