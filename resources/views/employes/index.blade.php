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
            vertical-align: middle;
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

        .photo{
            border-radius:8px;
            object-fit:cover;
        }

        .doc-link{
            display:block;
            color:blue;
            text-decoration:underline;
            margin-bottom:3px;
        }
    </style>
</head>

<body>

    <h1>Liste des employés</h1>

    <a href="{{ route('employes.create') }}">+ Ajouter un employé</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Poste</th>
            <th>Département</th>
            <th>Documents</th>
            <th>Actions</th>
        </tr>

        @forelse($employes as $employe)
        <tr>
            <td>{{ $employe->id }}</td>

            <!-- PHOTO -->
            <td>
                @if($employe->photo)
                    <img src="{{ asset('storage/' . $employe->photo) }}"
                         width="60"
                         height="60"
                         class="photo">
                @else
                    <span>Pas de photo</span>
                @endif
            </td>

            <td>{{ $employe->nom }}</td>
            <td>{{ $employe->prenom }}</td>
            <td>{{ $employe->email }}</td>
            <td>{{ $employe->poste }}</td>
            <td>{{ $employe->departement->nom ?? 'N/A' }}</td>

            <!-- DOCUMENTS -->
            <td>
                @forelse(json_decode($employe->documents ?? '[]') as $doc)
                    <a class="doc-link"
                       href="{{ asset('storage/' . $doc) }}"
                       target="_blank">
                        📄 Télécharger
                    </a>
                @empty
                    <span>Aucun document</span>
                @endforelse
            </td>

            <td>
                <a class="btn-edit" href="{{ route('employes.edit', $employe->id) }}">
                    Modifier
                </a>

                <form action="{{ route('employes.destroy', $employe->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete"
                            onclick="return confirm('Supprimer cet employé ?')">
                        X
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center;">
                Aucun employé trouvé
            </td>
        </tr>
        @endforelse

    </table>

</body>
</html>