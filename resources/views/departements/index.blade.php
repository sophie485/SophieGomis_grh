<!DOCTYPE html>
<html>
<head>
    <title>Liste des départements</title>

    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }

        h1{
            color:#111;
        }

        ul{
            background:white;
            padding:20px;
            border-radius:8px;
            list-style:none;
        }

        li{
            padding:10px;
            border-bottom:1px solid #ddd;
        }

        li:last-child{
            border-bottom:none;
        }
    </style>
</head>

<body>

    <h1>Liste des départements</h1>

    <ul>
        @foreach($departements as $departement)
            <li>{{ $departement->nom }}</li>
        @endforeach
    </ul>

</body>
</html>