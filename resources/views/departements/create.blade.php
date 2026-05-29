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

        h1{
            margin-bottom:20px;
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
    </style>
</head>
<body>

<h1>Ajouter un employé</h1>

<form action="{{ route('employes.store') }}" method="POST">
    @csrf

    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="telephone" placeholder="Téléphone" required>
    <input type="text" name="poste" placeholder="Poste" required>

    <input type="date" name="date_embauche" required>

    <input type="number" step="0.01" name="salaire" placeholder="Salaire" required>

    <button type="submit">Enregistrer</button>

</form>

</body>
</html>