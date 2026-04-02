<form action="{{ route('panier.updateQuantite') }}" method="POST">
    @csrf
    @method('PUT')

    {{-- tableau --}}
    @foreach($panier as $item)

        {{-- INPUT QUANTITÉ --}}
        <input type="number" name="quantite[{{ $item->id }}]">

    @endforeach

    <button type="submit">Mettre à jour</button>

</form>

{{-- FORM DELETE SÉPARÉ --}}
@foreach($panier as $item)

<form action="{{ route('panier.destroy', $item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button>Supprimer</button>
</form>

@endforeach