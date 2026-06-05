<!DOCTYPE html>
<html>
<head>
    <title>Modifier contrat</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f6f9;
            padding:40px;
        }

        form{
            background:white;
            padding:20px;
            border-radius:5px;
            max-width:600px;
        }

        input, select{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        button{
            background:black;
            color:white;
            border:none;
            padding:10px 15px;
        }
    </style>
</head>
<body>

<h1>Modifier un contrat</h1>

<form action="{{ route('contrats.update', $contrat->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <label>Employé</label>

    <select name="employe_id" required>

        @foreach($employes as $employe)

            <option value="{{ $employe->id }}"
                {{ $contrat->employe_id == $employe->id ? 'selected' : '' }}>

                {{ $employe->nom }}
                {{ $employe->prenom }}

            </option>

        @endforeach

    </select>

    <label>Type</label>

    <select name="type">

        <option value="CDI" {{ $contrat->type=='CDI' ? 'selected' : '' }}>
            CDI
        </option>

        <option value="CDD" {{ $contrat->type=='CDD' ? 'selected' : '' }}>
            CDD
        </option>

        <option value="Stage" {{ $contrat->type=='Stage' ? 'selected' : '' }}>
            Stage
        </option>

        <option value="Freelance" {{ $contrat->type=='Freelance' ? 'selected' : '' }}>
            Freelance
        </option>

    </select>

    <label>Date début</label>

    <input type="date"
           name="date_debut"
           value="{{ $contrat->date_debut }}">

    <label>Date fin</label>

    <input type="date"
           name="date_fin"
           value="{{ $contrat->date_fin }}">

    <label>Salaire</label>

    <input type="number"
           step="0.01"
           name="salaire"
           value="{{ $contrat->salaire }}">

    <label>Statut</label>

    <select name="statut">
        <option value="Actif"
            {{ $contrat->statut=='Actif' ? 'selected' : '' }}>
            Actif
        </option>

        <option value="Terminé"
            {{ $contrat->statut=='Terminé' ? 'selected' : '' }}>
            Terminé
        </option>
    </select>

    <button type="submit">
        Mettre à jour
    </button>

</form>

</body>
</html>