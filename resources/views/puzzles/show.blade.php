<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Puzzle') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
            <div class="flex items-center">
                <!-- Image du puzzle -->
                <div class="w-1/2 pr-6">
                    <img src="{{ asset('images/puzzles/' . $puzzle->image) }}" alt="{{ $puzzle->nom }}" class="rounded-lg shadow-lg w-full">
                </div>
                
                <!-- Détails du puzzle -->
                <div class="w-1/2">
                    <h3 class="text-2xl font-semibold mb-4">{{ $puzzle->nom }}</h3>
                    <p class="text-gray-700 mb-4">{{ $puzzle->description }}</p>
                    <p class="text-lg font-semibold">{{ number_format($puzzle->prix, 2, ',', ' ') }} €</p>
                    
                    <div class="mt-6">
                        <form action="{{ route('panier.ajouter') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $puzzle->id }}">
                            <input type="number" name="quantite" value="1" min="1" class="w-16 border rounded px-2 py-1 mb-4" />
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Ajouter au panier
                            </button>
                        </form>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('commandes.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Commander directement
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
