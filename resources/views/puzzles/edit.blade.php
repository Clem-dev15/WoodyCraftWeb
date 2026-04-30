@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-8">
            <h1 class="text-2xl font-bold mb-6">Éditer un puzzle</h1>

            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('puzzles.update', $puzzle->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom
                    </label>
                    <input
                        id="nom"
                        type="text"
                        name="nom"
                        value="{{ old('nom', $puzzle->nom) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                </div>

                <div>
                    <label for="categorie_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Catégorie
                    </label>
                    <select
                        id="categorie_id"
                        name="categorie_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
                    >
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}"
                                {{ old('categorie_id', $puzzle->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    >{{ old('description', $puzzle->description) }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                        Nouvelle image
                    </label>
                    <input
                        id="image"
                        type="file"
                        name="image"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white"
                    >

                    @if($puzzle->image)
                        <div class="mt-3">
                            <p class="text-sm text-gray-600 mb-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $puzzle->image) }}"
                                 alt="{{ $puzzle->nom }}"
                                 class="h-32 rounded border">
                        </div>
                    @endif
                </div>

                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                        Prix
                    </label>
                    <input
                        id="prix"
                        type="number"
                        step="0.01"
                        name="prix"
                        value="{{ old('prix', $puzzle->prix) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2"
                        required
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
                                {{ old('fournisseur_id', $puzzle->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800"
                    >
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection