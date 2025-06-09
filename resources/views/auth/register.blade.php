<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion Pharmacie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-color: #f8f9fa;
            --dark-color: #1a252f;
            --error-color: #e74c3c;
            --overlay-color: rgba(44, 62, 80, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('/login5.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--overlay-color);
            z-index: 1;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 450px;
            position: relative;
            z-index: 2;
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 1.8rem;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 38px; /* Alignement parfait avec le champ */
            color: var(--primary-color);
            opacity: 0.7;
            font-size: 1rem;
        }

        input, select {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        button {
            width: 100%;
            padding: 0.9rem;
            margin: 1.5rem 0;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background-color: var(--dark-color);
        }

        .errors {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--error-color);
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-left: 3px solid var(--error-color);
        }

        .errors ul {
            list-style: none;
            padding-left: 0;
        }

        .errors li {
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-link {
            margin-top: 1rem;
            display: block;
            text-align: center;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-user-plus"></i>Créer un compte</h2>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.register.post') }}">
            @csrf

            <div class="form-group">
                <label for="nom">Nom complet</label>
                <i class="fas fa-user input-icon"></i>
                <input type="text" id="nom" name="nom" placeholder="Votre nom complet" value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" id="email" name="email" placeholder="exemple@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password" name="password" >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmation</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password_confirmation" name="password_confirmation" >
            </div>

           

            <button type="submit">
                <i class="fas fa-user-plus"></i>S'inscrire
            </button>
        </form>

        <a class="login-link" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>Déjà un compte ? Connectez-vous
        </a>
    </div>
</body>
</html>