<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $puzzle->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-2xl font-bold mb-4">{{ $puzzle->nom }}</h3>

                @if(!empty($puzzle->description))
                    <p class="text-gray-700 mb-4">{{ $puzzle->description }}</p>
                @endif

                <p class="text-lg font-semibold mb-6">
                    Prix : {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                </p>

                <form action="{{ route('panier.ajouter') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $puzzle->id }}">

                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>