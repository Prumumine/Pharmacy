<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        /* Style modernisé */
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #2c5364;
        }

        .login-container input, .login-container button {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .login-container button {
            background-color: #2c5364;
            color: white;
            border: none;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #1b2a36;
        }

        .login-container .links a {
            color: #2c5364;
            text-decoration: none;
            margin: 0 5px;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }

        .erreur {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <h2>Connexion</h2>

            {{-- Message d’erreur général --}}
            @if ($errors->any())
                <div class="erreur">
                    {{ $errors->first() }}
                </div>
            @endif

            <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit">Se connecter</button>

            <div class="links">
                <a href="{{ route('auth.register') }}">Créer un compte</a> |
                <a href="{{ route('auth.forgot') }}">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
</body>
</html>
