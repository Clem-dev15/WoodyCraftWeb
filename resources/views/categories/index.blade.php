<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catégories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($categories->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    Aucune catégorie.
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($categories as $categorie)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-semibold">{{ $categorie->nom }}</h3>

                                <a href="{{ route('categories.show', $categorie->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Voir
                                </a>
                            </div>

                            @if($categorie->puzzles->isEmpty())
                                <p class="text-gray-500">Aucun puzzle dans cette catégorie.</p>
                            @else
                                <ul class="list-disc list-inside text-sm text-gray-700">
                                    @foreach($categorie->puzzles as $puzzle)
                                        <li>{{ $puzzle->nom }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>