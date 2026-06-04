<!DOCTYPE html>
<html>
<head>
    <title>Demande de congé</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .container{
            background:white;
            width:500px;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        h1{
            text-align:center;
        }

        input, select, textarea{
            width:100%;
            padding:10px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:12px;
            background:black;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#333;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Demande de congé</h1>

    <form action="{{ route('conges.store') }}" method="POST">
        @csrf

        <select name="employe_id" required>
            <option value="">Choisir un employé</option>

            @foreach($employes as $employe)
                <option value="{{ $employe->id }}">
                    {{ $employe->nom }} {{ $employe->prenom }}
                </option>
            @endforeach
        </select>

        <select name="type" required>
            <option value="Annuel">Annuel</option>
            <option value="Maladie">Maladie</option>
            <option value="Maternite">Maternité</option>
            <option value="Sans solde">Sans solde</option>
        </select>

        <input type="date" name="date_debut" required>

        <input type="date" name="date_fin" required>

        <textarea name="motif" placeholder="Motif"></textarea>

        <button type="submit">
            Envoyer la demande
        </button>
    </form>

</div>

</body>
</html>