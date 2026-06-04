<!DOCTYPE html>
<html>
<head>
    <title>Détails Congé</title>

    <style>
        body{
            font-family: Arial;
            padding: 40px;
            background: #f4f6f9;
        }

        .card{
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .btn{
            display:inline-block;
            padding:10px 15px;
            background:black;
            color:white;
            text-decoration:none;
            border-radius:5px;
            margin-bottom:20px;
        }

        .approuve{color:green;font-weight:bold;}
        .refuse{color:red;font-weight:bold;}
        .attente{color:orange;font-weight:bold;}
    </style>
</head>
<body>

<a href="{{ route('conges.index') }}" class="btn">← Retour</a>

<div class="card">
    <h2>Détails du congé</h2>

    <p><strong>Employé :</strong>
        {{ $conge->employe->nom ?? '' }}
        {{ $conge->employe->prenom ?? '' }}
    </p>

    <p><strong>Type :</strong> {{ $conge->type }}</p>

    <p><strong>Date début :</strong> {{ $conge->date_debut }}</p>

    <p><strong>Date fin :</strong> {{ $conge->date_fin }}</p>

    <p><strong>Motif :</strong> {{ $conge->motif }}</p>

    <p><strong>Statut :</strong>
        @if($conge->statut == 'En attente')
            <span class="attente">{{ $conge->statut }}</span>
        @elseif($conge->statut == 'Approuvé')
            <span class="approuve">{{ $conge->statut }}</span>
        @else
            <span class="refuse">{{ $conge->statut }}</span>
        @endif
    </p>
</div>

</body>
</html>