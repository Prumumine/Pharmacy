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
            margin: 0;
        }

        .container {
            background: white;
            padding: 35px 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #2c5364;
        }

        label {
            display: block;
            margin-top: 15px;
            text-align: left;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            box-sizing: border-box;
            transition: 0.3s border-color ease;
        }

        input:focus, select:focus {
            border-color: #2c5364;
            outline: none;
        }

        button {
            background-color: #2c5364;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 25px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1b2a36;
        }

        .errors {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }

        ul {
            padding-left: 20px;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: #2c5364;
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

        <form method="POST" action="{{ route('auth.register.post') }}">
            @csrf

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <label for="role">Rôle</label>
            <select id="role" name="role" required>
                <option value="client" selected>Client</option>
                <option value="pharmacien">Pharmacien</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">S'inscrire</button>
        </form>

        <a class="login-link" href="{{ route('login') }}">Déjà inscrit ? Connectez-vous</a>
    </div>
</body>
</html>
