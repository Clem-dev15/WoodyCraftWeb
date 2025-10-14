<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h1 { text-align: center; }
        .total { font-weight: bold; }
    </style>
</head>
<body>

<h1>Facture de votre commande</h1>

<p><strong>Adresse de livraison :</strong> 
    {{ $adresse['numero_rue'] ?? '' }} {{ $adresse['nom_rue'] ?? '' }}, 
    {{ $adresse['ville'] ?? '' }} ({{ $adresse['departement'] ?? '' }})
</p>


<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($panier as $item)
            @php
                $sousTotal = $item['quantite'] * $item['prix'];
                $total += $sousTotal;
            @endphp
            <tr>
                <td>{{ $item['nom'] }}</td>
                <td>{{ $item['quantite'] }}</td>
                <td>{{ number_format($item['prix'], 2) }} €</td>
                <td>{{ number_format($sousTotal, 2) }} €</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="total">Total général</td>
            <td class="total">{{ number_format($total, 2) }} €</td>
        </tr>
    </tbody>
</table>

<p>Merci pour votre commande !</p>

<p><strong>Adresse ou envoyer le chèque :</strong> 
    'Adresse de Woodycraft'
</p>

</body>
</html>
