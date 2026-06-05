<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un contrat</title>

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

<h1>Ajouter un contrat</h1>

<form action="{{ route('contrats.store') }}" method="POST">

    @csrf

    <label>Employé</label>

    <select name="employe_id" required>
        <option value="">Choisir</option>

        @foreach($employes as $employe)
            <option value="{{ $employe->id }}">
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>

    <label>Type de contrat</label>

    <select name="type" required>
        <option value="CDI">CDI</option>
        <option value="CDD">CDD</option>
        <option value="Stage">Stage</option>
        <option value="Freelance">Freelance</option>
    </select>

    <label>Date début</label>
    <input type="date" name="date_debut" required>

    <label>Date fin</label>
    <input type="date" name="date_fin">

    <label>Salaire</label>
    <input type="number" step="0.01" name="salaire">

    <button type="submit">
        Enregistrer
    </button>

</form>

</body>
</html>