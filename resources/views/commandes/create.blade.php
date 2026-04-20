<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validation de la commande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('commandes.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1 font-medium">Ville</label>
                        <input type="text" name="ville" value="{{ old('ville') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Département</label>
                        <input type="text" name="departement" value="{{ old('departement') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Nom de rue</label>
                        <input type="text" name="nom_rue" value="{{ old('nom_rue') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Numéro de rue</label>
                        <input type="text" name="numero_rue" value="{{ old('numero_rue') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Paiement</label>
                        <select name="paiement" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="cheque" {{ old('paiement') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                            <option value="paypal" {{ old('paiement') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            <option value="carte" {{ old('paiement') == 'carte' ? 'selected' : '' }}>Carte bancaire</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Numéro de carte</label>
                        <input type="text" name="numero_carte" value="{{ old('numero_carte') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Date d'expiration</label>
                        <input type="text" name="date_expiration" value="{{ old('date_expiration') }}" placeholder="MM/AA" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">CVV</label>
                        <input type="text" name="cvv" value="{{ old('cvv') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Valider la commande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>