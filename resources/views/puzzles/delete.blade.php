@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Êtes-vous sûr de vouloir supprimer ce puzzle ?</h2>
        
        <div class="mb-4">
            <p>Cette action est irréversible et supprimera définitivement le puzzle.</p>
        </div>

        <form action="{{ route('puzzles.destroy', $puzzle->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-between">
                <a href="{{ route('puzzles.index') }}" class="text-blue-600 hover:text-blue-800">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
@endsection
