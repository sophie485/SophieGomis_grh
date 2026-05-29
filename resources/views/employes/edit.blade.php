<!DOCTYPE html>
<html>
<head>
    <title>Modifier un employé</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }

        form{
            background:white;
            padding:20px;
            width:400px;
            border-radius:8px;
        }

        input, select{
            width:100%;
            padding:10px;
            margin-bottom:10px;
        }

        button{
            background:black;
            color:white;
            padding:10px;
            border:none;
            width:100%;
            cursor:pointer;
        }

        img{
            width:80px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<h1>Modifier un employé</h1>

<form action="{{ route('employes.update', $employe->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="nom" value="{{ $employe->nom }}" required>

    <input type="text" name="prenom" value="{{ $employe->prenom }}" required>

    <input type="email" name="email" value="{{ $employe->email }}" required>

    <input type="text" name="telephone" value="{{ $employe->telephone }}" required>

    <input type="text" name="poste" value="{{ $employe->poste }}" required>

    <!-- DEPARTEMENT -->
    <select name="departement_id" required>
        <option value="">Choisir un département</option>

        @foreach($departements as $departement)
            <option value="{{ $departement->id }}"
                {{ $employe->departement_id == $departement->id ? 'selected' : '' }}>
                {{ $departement->nom }}
            </option>
        @endforeach
    </select>

    <input type="date" name="date_embauche" value="{{ $employe->date_embauche }}" required>

    <input type="number" name="salaire" value="{{ $employe->salaire }}" required>

    <!-- PHOTO -->
    @if($employe->photo)
        <img src="{{ asset('storage/' . $employe->photo) }}">
    @endif

    <input type="file" name="photo">

    <!-- DOCUMENTS -->
    <input type="file" name="documents[]" multiple>

    <button type="submit">Modifier</button>

</form>

</body>
</html>