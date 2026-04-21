@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        {{-- HERO --}}
        <section class="bg-white rounded-xl shadow-sm p-8 border border-gray-200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">
                        Bienvenue sur WoodyCraft
                    </p>

                    <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">
                        Trouvez le puzzle parfait pour chaque passion
                    </h1>

                    <p class="text-gray-600 text-lg mb-6">
                        Découvrez nos puzzles en bois, plastique et métal, pensés pour offrir une expérience ludique et élégante.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('puzzles.index') }}"
                           class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                            Voir tous les puzzles
                        </a>

                        <a href="{{ route('categories.index') }}"
                           class="px-6 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-50">
                            Parcourir les catégories
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-100 to-orange-50 rounded-xl p-8 border border-amber-200">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <p class="text-sm text-gray-500">Puzzles disponibles</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $puzzles->count() }}</p>
                        </div>

                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <p class="text-sm text-gray-500">Catégories</p>
                            <p class="text-2xl font-bold text-gray-900">3+</p>
                        </div>

                        <div class="bg-white rounded-lg p-4 shadow-sm col-span-2">
                            <p class="text-sm text-gray-500">Expérience</p>
                            <p class="text-lg font-semibold text-gray-900">Des puzzles design et originaux pour tous les goûts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- RECHERCHE --}}
        <section class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Rechercher un puzzle..."
                    class="flex-1 rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                >

                <button
                    type="submit"
                    class="px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-lg hover:bg-yellow-300"
                >
                    Rechercher
                </button>
            </form>
        </section>

        {{-- SECTION PRODUITS --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-900">Nos puzzles</h2>

                <a href="{{ route('puzzles.index') }}" class="text-sm text-blue-600 hover:underline">
                    Voir plus
                </a>
            </div>

            @if($puzzles->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <p class="text-gray-600">Aucun puzzle trouvé.</p>
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