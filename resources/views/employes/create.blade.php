<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un employé</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }

        .container{
            max-width:600px;
            margin:auto;
            background:white;
            padding:20px;
            border-radius:10px;
        }

        input, select{
            width:100%;
            padding:10px;
            margin-bottom:10px;
        }

        button{
            width:100%;
            padding:12px;
            background:black;
            color:white;
            border:none;
            cursor:pointer;
        }

        h1{
            text-align:center;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Ajouter un employé</h1>

    <form action="{{ route('employes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nom" placeholder="Nom" required>

        <input type="text" name="prenom" placeholder="Prénom" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="text" name="telephone" placeholder="Téléphone (9 chiffres)" maxlength="9" required>

        <input type="text" name="poste" placeholder="Poste" required>

        <!-- 🔥 Départements -->
        <select name="departement_id" required>
            <option value="">-- Choisir un département --</option>

            @foreach($departements as $departement)
                <option value="{{ $departement->id }}">
                    {{ $departement->nom }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date_embauche" required>

        <input type="number" step="0.01" name="salaire" placeholder="Salaire" required>

        <!-- Photo -->
        <label>Photo</label>
        <input type="file" name="photo" accept="image/*">

        <!-- Documents -->
        <label>Documents</label>
        <input type="file" name="documents[]" multiple>

        <button type="submit">Enregistrer</button>

    </form>

</div>

</body>
</html>