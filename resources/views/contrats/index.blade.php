<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contrats</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            padding:40px;
        }

        h1{
            margin-bottom:20px;
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

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th{
            background:black;
            color:white;
            padding:12px;
        }

        td{
            padding:12px;
            border:1px solid #ddd;
        }

        .alerte{
            background:#fff3cd;
            color:#856404;
            padding:15px;
            border-radius:5px;
            margin-bottom:20px;
        }

        .edit{
            background:orange;
            color:white;
            padding:5px 10px;
            text-decoration:none;
            border-radius:4px;
        }

        .delete{
            background:red;
            color:white;
            border:none;
            padding:5px 10px;
            border-radius:4px;
            cursor:pointer;
        }
    </style>
</head>
<body>

<h1>Gestion des contrats</h1>

@if(session('success'))
    <div class="alerte">
        {{ session('success') }}
    </div>
@endif

@if($alertes->count())
<div class="alerte">
    <strong>⚠ Contrats arrivant à expiration :</strong>

    <ul>
        @foreach($alertes as $alerte)
            <li>
                {{ $alerte->employe->nom }}
                {{ $alerte->employe->prenom }}
                - Fin : {{ $alerte->date_fin }}
            </li>
        @endforeach
    </ul>
</div>
@endif

<a href="{{ route('contrats.create') }}" class="btn">
    + Nouveau contrat
</a>

<table>
    <tr>
        <th>ID</th>
        <th>Employé</th>
        <th>Type</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Salaire</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    @forelse($contrats as $contrat)
    <tr>

        <td>{{ $contrat->id }}</td>

        <td>
            {{ $contrat->employe->nom ?? '' }}
            {{ $contrat->employe->prenom ?? '' }}
        </td>

        <td>{{ $contrat->type }}</td>

        <td>{{ $contrat->date_debut }}</td>

        <td>{{ $contrat->date_fin ?? 'Aucune' }}</td>

        <td>{{ $contrat->salaire }}</td>

        <td>{{ $contrat->statut }}</td>

        <td>

            <a href="{{ route('contrats.edit', $contrat->id) }}"
               class="edit">
                Modifier
            </a>

            <form action="{{ route('contrats.destroy', $contrat->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="delete"
                        onclick="return confirm('Supprimer ce contrat ?')">
                    Supprimer
                </button>

            </form>

        </td>

    </tr>
    @empty
    <tr>
        <td colspan="8" style="text-align:center;">
            Aucun contrat enregistré
        </td>
    </tr>
    @endforelse

</table>

</body>
</html>