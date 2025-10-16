<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Puzzles dans la catégorie : ') }} {{ $categorie->nom }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        @if (session()->has('message'))
            <div class="mt-3 mb-4 text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto border-b border-gray-200 shadow pt-6 bg-white">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-2 text-xs text-gray-500">#</th>
                        <th class="px-2 py-2 text-xs text-gray-500">Nom du puzzle</th>
                        <th class="px-2 py-2 text-xs text-gray-500">Prix</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($categorie->puzzles->isEmpty())
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">
                                <em>Aucun puzzle pour cette catégorie.</em>
                            </td>
                        </tr>
                    @else
                        @foreach ($categorie->puzzles as $puzzle)
                            <tr>
                                <td class="px-4 py-4 text-sm text-gray-500">{{ $puzzle->id }}</td>
                                <td class="px-4 py-4 flex items-center space-x-4">
                                    <img src="{{ asset($puzzle->image) }}" alt="Image {{ $puzzle->nom }}" class="w-20 h-20 object-cover rounded">
                                    <span>{{ $puzzle->nom }}</span>
                                </td>
                                <td class="px-4 py-4">{{ $puzzle->nom }}</td>
                                <td class="px-4 py-4">{{ number_format($puzzle->prix, 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                    @endif
                    <td class="px-2 py-2">
                        <a href="{{ route('categories.index') }}" class="text-blue-600 underline">
                            ← Retour à la liste des catégories
                        </a>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
