<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Éditer un puzzle') }}
        </h2>
    </x-slot>

    <x-puzzles-card>
        {{-- Message de réussite --}}
        @if (session()->has('message'))
            <div class="mt-3 mb-4 text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('puzzles.update', $puzzle) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nom --}}
            <div>
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input id="nom" class="block mt-1 w-full"
                              type="text" name="nom"
                              :value="old('nom', $puzzle->nom)"
                              required autofocus />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            {{-- Catégorie --}}
            <div class="mt-4">
                <x-input-label for="categorie" :value="__('Catégorie')" />
                <x-textarea id="categorie" name="categorie" rows="2" class="block mt-1 w-full">
                    {{ old('categorie', $puzzle->categorie) }}
                </x-textarea>
                <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea id="description" name="description" rows="2" class="block mt-1 w-full">
                    {{ old('description', $puzzle->description) }}
                </x-textarea>
                <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
            </div>

            {{-- Image --}}
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <x-text-input id="image" class="block mt-1 w-full"
                              type="text" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            {{-- Prix --}}
            <div class="mt-4">
                <x-input-label for="prix" :value="__('Prix')" />
                <x-text-input id="prix" class="block mt-1 w-full"
                              type="number" name="prix"
                              step="0.01"
                              :value="old('prix', $puzzle->prix)" required />
                <x-input-error :messages="$errors->get('prix')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    {{ __('Mettre à jour') }}
                </x-primary-button>
            </div>
        </form>
    </x-puzzles-card>
</x-app-layout>
