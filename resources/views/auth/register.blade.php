<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Gestion Pharmacie</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            text-align: center;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #2c5364;
            outline: none;
        }
        button {
            background-color: #2c5364;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #1b2a36;
        }
        .errors {
            color: red;
            margin-bottom: 10px;
            text-align: left;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>
</body>
</html>
