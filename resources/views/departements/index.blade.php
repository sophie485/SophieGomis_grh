<!DOCTYPE html>
<html>
<head>
    <title>Liste des employés</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }

        h1{
            color:#111;
        }

        a{
            display:inline-block;
            margin-bottom:15px;
            padding:10px 15px;
            background:black;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            background:white;
        }

        th, td{
            padding:12px;
            border:1px solid #ddd;
            text-align:left;
        }

        th{
            background:black;
            color:white;
        }

        .btn-delete{
            color:white;
            background:red;
            padding:5px 10px;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        .btn-edit{
            color:white;
            background:orange;
            padding:5px 10px;
            border:none;
            border-radius:5px;
            text-decoration:none;
        }
    </style>
</head>

<body>

    <h1>Liste des employés</h1>

    <!-- Bouton ajouter -->
    <a href="{{ route('employes.create') }}">+ Ajouter un employé</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Poste</th>
            <th>Département</th>
            <th>Actions</th>
        </tr>

        @forelse($employes as $employe)
        <tr>
            <td>{{ $employe->id }}</td>
            <td>{{ $employe->nom }}</td>
            <td>{{ $employe->prenom }}</td>
            <td>{{ $employe->email }}</td>
            <td>{{ $employe->poste }}</td>
            <td>{{ $employe->departement->nom ?? 'N/A' }}</td>

            <td>
                <!-- Modifier -->
                <a class="btn-edit" href="{{ route('employes.edit', $employe->id) }}">
                    Modifier
                </a>

                <!-- Supprimer -->
                <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete" onclick="return confirm('Supprimer cet employé ?')">
                        X
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center;">
                Aucun employé trouvé
            </td>
        </tr>
        @endforelse

    </table>

</body>
</html>