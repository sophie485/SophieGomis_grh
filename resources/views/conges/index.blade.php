<!DOCTYPE html>
<html>
<head>
    <title>Liste des congés</title>

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
            text-align:center;
        }

        .attente{
            color:orange;
            font-weight:bold;
        }

        .approuve{
            color:green;
            font-weight:bold;
        }

        .refuse{
            color:red;
            font-weight:bold;
        }

        .solde{
            background:#e8f5e9;
            color:#2e7d32;
            padding:6px 12px;
            border-radius:20px;
            font-weight:bold;
            display:inline-block;
        }

        .btn-approve{
            background:#28a745;
            color:white;
            border:none;
            padding:6px 10px;
            border-radius:5px;
            cursor:pointer;
        }

        .btn-refuse{
            background:#dc3545;
            color:white;
            border:none;
            padding:6px 10px;
            border-radius:5px;
            cursor:pointer;
        }

        .actions{
            display:flex;
            justify-content:center;
            gap:5px;
        }
    </style>
</head>
<body>

<h1>Gestion des congés</h1>

<a href="{{ route('conges.create') }}" class="btn">
    + Nouvelle demande
</a>

<table>
    <tr>
        <th>ID</th>
        <th>Employé</th>
        <th>Type</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Motif</th>
        <th>Statut</th>
        <th>Actions</th>
        <th>Solde congés</th>
    </tr>

    @forelse($conges as $conge)
    <tr>
        <td>{{ $conge->id }}</td>

        <td>
            {{ $conge->employe->nom ?? '' }}
            {{ $conge->employe->prenom ?? '' }}
        </td>

        <td>{{ $conge->type }}</td>

        <td>{{ $conge->date_debut }}</td>

        <td>{{ $conge->date_fin }}</td>

        <td>{{ $conge->motif }}</td>

        <!-- STATUT -->
        <td>
            @if($conge->statut == 'En attente')
                <span class="attente">En attente</span>
            @elseif($conge->statut == 'Approuvé')
                <span class="approuve">Approuvé</span>
            @else
                <span class="refuse">Refusé</span>
            @endif
        </td>

        <!-- ACTIONS -->
        <td>
            @if($conge->statut == 'En attente')
            <div class="actions">

                <form action="{{ route('conges.approuver', $conge->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn-approve">
                        ✓
                    </button>
                </form>

                <form action="{{ route('conges.refuser', $conge->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn-refuse">
                        ✕
                    </button>
                </form>

            </div>
            @else
                <strong>-</strong>
            @endif
        </td>

        <!-- SOLDE -->
        <td>
            <span class="solde">
                {{ $conge->employe->solde_conges ?? 0 }} jours
            </span>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9" style="text-align:center;">
            Aucun congé enregistré
        </td>
    </tr>
    @endforelse

</table>

</body>
</html>