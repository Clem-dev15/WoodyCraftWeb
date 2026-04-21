@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        {{-- EN-TÊTE --}}
        <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">
                Univers WoodyCraft
            </p>

            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                Catégories
            </h1>

            <p class="text-gray-600 text-lg max-w-2xl">
                Explorez nos différentes catégories et découvrez les puzzles qui correspondent à vos envies.
            </p>
        </section>

        {{-- LISTE DES CATÉGORIES --}}
        @if($categories->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600">Aucune catégorie disponible.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($categories as $categorie)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">

                        {{-- TITRE --}}
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">
                                    Catégorie
                                </p>
                                <h2 class="text-2xl font-bold text-gray-900">
                                    {{ $categorie->nom }}
                                </h2>
                            </div>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                {{ $categorie->puzzles->count() }} puzzle{{ $categorie->puzzles->count() > 1 ? 's' : '' }}
                            </span>
                        </div>

                        {{-- DESCRIPTION / APERÇU --}}
                        @if($categorie->puzzles->isEmpty())
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-5">
                                <p class="text-gray-500 text-sm">
                                    Aucun puzzle disponible dans cette catégorie pour le moment.
                                </p>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-5">
                                <p class="text-sm font-medium text-gray-700 mb-3">
                                    Aperçu des puzzles :
                                </p>

                                <div class="flex flex-wrap gap-2">
                                    @foreach($categorie->puzzles->take(3) as $puzzle)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-white border border-gray-200 text-gray-700">
                                            {{ $puzzle->nom }}
                                        </span>
                                    @endforeach

                                    @if($categorie->puzzles->count() > 3)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            + {{ $categorie->puzzles->count() - 3 }} autres
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- ACTION --}}
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500">
                                Voir tous les puzzles de cette catégorie
                            </p>

                            <a href="{{ route('categories.show', $categorie->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                                Voir
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection