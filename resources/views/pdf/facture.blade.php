<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        .header{
            text-align: center;
        }
        .content{
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Soa-Parking</h2>
    <h2>Notice d'information</h2>
    <h2>N° : {{ $stationnement->id }}</h2>
</div>
<div class="content">
    <h3>Mr/Mme : {{ $stationnement->user->prenoms }} {{ $stationnement->user->nom }}</h3>
    <h3>N° voiture : {{ $stationnement->voiture->numero }}</h3>
    <h3>Parking : {{ $stationnement->parking->numero }}</h3>
    <h3>Durée : {{ $stationnement->duree_reel }} heure(s)</h3>
    <h3>Montant : {{ $stationnement->amende+$stationnement->montant }} Ar</h3>
</div>
</body>
</html>
