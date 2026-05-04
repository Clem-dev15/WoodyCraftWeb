@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        {{-- HEADER + TRI --}}
        <section class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-3xl font-bold text-gray-900">Puzzles</h1>

            <form method="GET" action="{{ route('puzzles.index') }}">
                <select name="tri"
                        onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 bg-white">

                    <option value="">Trier par</option>

                    <option value="nom" {{ request('tri') == 'nom' ? 'selected' : '' }}>
                        Nom (A → Z)
                    </option>

                    <option value="prix_asc" {{ request('tri') == 'prix_asc' ? 'selected' : '' }}>
                        Prix croissant
                    </option>

                    <option value="prix_desc" {{ request('tri') == 'prix_desc' ? 'selected' : '' }}>
                        Prix décroissant
                    </option>

                    <option value="fournisseur" {{ request('tri') == 'fournisseur' ? 'selected' : '' }}>
                        Fournisseur
                    </option>
                </select>
            </form>
        </section>

        {{-- LISTE DES PUZZLES --}}
        @if($puzzles->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <p class="text-gray-600">Aucun puzzle disponible.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                @foreach($puzzles as $puzzle)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">

                        {{-- IMAGE --}}
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            @if(!empty($puzzle->image))
                                <img src="{{ asset('storage/' . $puzzle->image) }}"
                                     alt="{{ $puzzle->nom }}"
                                     class="h-full w-full object-cover">
                            @else
                                <span class="text-gray-400 text-sm">Aucune image</span>
                            @endif
                        </div>

                        {{-- CONTENU --}}
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

                            {{-- ACTIONS --}}
                            <div class="flex gap-2 flex-wrap">

                                {{-- VOIR --}}
                                <a href="{{ route('puzzles.show', $puzzle->id) }}"
                                   class="flex-1 text-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                                    Voir
                                </a>

                                {{-- PANIER --}}
                                <form action="{{ route('panier.ajouter') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $puzzle->id }}">

                                    <button type="submit"
                                            class="w-full px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-300">
                                        Panier
                                    </button>
                                </form>

                                {{-- MODIFIER --}}
                                <a href="{{ route('puzzles.edit', $puzzle->id) }}"
                                   class="w-full text-center px-4 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300">
                                    Modifier
                                </a>

                                <form action="{{ route('puzzles.destroy', $puzzle->id) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce puzzle ?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded">
                                        Supprimer
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>
@endsection