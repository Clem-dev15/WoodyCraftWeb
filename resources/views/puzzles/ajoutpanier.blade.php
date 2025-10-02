<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des puzzles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($puzzles as $puzzle)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $puzzle->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $puzzle->prix }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('panier.ajouter') }}" method="POST" class="flex items-center">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $puzzle->id }}">
                                                <input type="hidden" name="nom" value="{{ $puzzle->nom }}">
                                                <input type="hidden" name="prix" value="{{ $puzzle->prix }}">

                                                <input 
                                                    type="number" 
                                                    name="quantite" 
                                                    value="1" 
                                                    min="1" 
                                                    class="w-20 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                                                >

                                                <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                                    Ajouter
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- Ici tu peux mettre un bouton voir détails par exemple --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
