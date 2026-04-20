<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Puzzles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($puzzles->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    Aucun puzzle disponible.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($puzzles as $puzzle)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-2">{{ $puzzle->nom }}</h3>

                            @if(!empty($puzzle->description))
                                <p class="text-sm text-gray-600 mb-3">{{ $puzzle->description }}</p>
                            @endif

                            <p class="font-bold mb-4">{{ number_format($puzzle->prix, 2, ',', ' ') }} €</p>

                            <a href="{{ route('puzzles.show', $puzzle->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Voir
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>