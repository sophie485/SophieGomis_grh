<!DOCTYPE html>
<html>
<head>
    <title>Détails Employé</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:10px;
        }

        img{
            border-radius:10px;
            object-fit:cover;
        }

        .section{
            margin-top:20px;
            padding:15px;
            background:#fafafa;
            border-radius:8px;
        }

        .doc-link{
            display:block;
            color:blue;
            margin-bottom:5px;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>Détails de l’employé</h1>

    <!-- PHOTO -->
    @if($employe->photo)
        <img src="{{ asset('storage/' . $employe->photo) }}" width="120" height="120">
    @else
        <p>Pas de photo</p>
    @endif

    <p><strong>Nom :</strong> {{ $employe->nom }}</p>
    <p><strong>Prénom :</strong> {{ $employe->prenom }}</p>
    <p><strong>Email :</strong> {{ $employe->email }}</p>
    <p><strong>Téléphone :</strong> {{ $employe->telephone }}</p>
    <p><strong>Poste actuel :</strong> {{ $employe->poste }}</p>
    <p><strong>Département :</strong> {{ $employe->departement->nom ?? 'N/A' }}</p>
    <p><strong>Salaire :</strong> {{ $employe->salaire }}</p>

    <!-- DOCUMENTS -->
    <div class="section">
        <h3>📄 Documents</h3>

        @forelse(json_decode($employe->documents ?? '[]') as $doc)
            <a class="doc-link"
               href="{{ asset('storage/' . $doc) }}"
               target="_blank">
                Télécharger document
            </a>
        @empty
            <p>Aucun document</p>
        @endforelse
    </div>

    <!-- HISTORIQUE POSTES -->
    <div class="section">
        <h3>📌 Historique des postes</h3>

        @if($employe->historiquePostes && $employe->historiquePostes->count() > 0)

            @foreach($employe->historiquePostes as $hist)
                <div style="background:#fff; padding:10px; margin-bottom:10px; border-radius:6px;">
                    <strong>📌 {{ $hist->poste }}</strong><br>

                    🗓️ Début :
                    {{ \Carbon\Carbon::parse($hist->date_debut)->format('d/m/Y') }} <br>

                    🛑 Fin :
                    {{ $hist->date_fin
                        ? \Carbon\Carbon::parse($hist->date_fin)->format('d/m/Y')
                        : 'Actuel' }}
                </div>
            @endforeach

        @else
            <p>Aucun historique disponible</p>
        @endif
    </div>

</div>

</body>
</html>