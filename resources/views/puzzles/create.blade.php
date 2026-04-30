@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-8">
            <h1 class="text-2xl font-bold mb-6">Créer un puzzle</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('puzzles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom du puzzle
                    </label>
                    <input
                        type="text"
                        name="nom"
                        id="nom"
                        value="{{ old('nom') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    >{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                        Prix
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        name="prix"
                        id="prix"
                        value="{{ old('prix') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                </div>

                <div>
                    <label for="categorie_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Catégorie
                    </label>
                    <select
                        name="categorie_id"
                        id="categorie_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                        Image du puzzle
                    </label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white"
                    >
                </div>
                <div>
                    <label for="fournisseur_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Fournisseur
                    </label>

                    <select
                        id="fournisseur_id"
                        name="fournisseur_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                        <option value="">-- Choisir un fournisseur --</option>

                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}"
                                {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button
                        type="submit"
                        class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800"
                    >
                        Créer le puzzle
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection