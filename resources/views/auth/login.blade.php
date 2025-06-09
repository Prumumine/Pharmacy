<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-color: #f8f9fa;
            --dark-color: #1a252f;
            --error-color: #e74c3c;
            --overlay-color: rgba(44, 62, 80, 0.4); /* Overlay plus léger */
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
            background-image: url('/login3.png');
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

        .login-container {
            background-color: rgba(255, 255, 255, 0.95); /* Fond semi-transparent */
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            position: relative;
            z-index: 2;
            animation: fadeIn 0.6s ease-out;
            backdrop-filter: blur(2px); /* Effet flou léger */
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container h2 {
            color: var(--primary-color);
            margin-bottom: 1.8rem;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            opacity: 0.7;
        }

        .login-container input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .login-container input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
            background-color: white;
        }

        .login-container button {
            width: 100%;
            padding: 0.9rem;
            margin: 1.2rem 0;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-container button:hover {
            background-color: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .erreur {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--error-color);
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1.2rem;
            font-size: 0.9rem;
            border-left: 3px solid var(--error-color);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin: 0.8rem 0;
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .remember-me input {
            width: auto;
            margin-right: 0.5rem;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }
            
            .links {
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <h2><i class="fas fa-prescription-bottle-alt"></i> Connexion</h2>

            @if ($errors->any())
                <div class="erreur">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>

            <div class="links">
                <a href="{{ route('auth.register') }}"><i class="fas fa-user-plus"></i> Créer un compte</a>
                <a href="{{ route('auth.forgot') }}"><i class="fas fa-key"></i> Mot de passe oublié</a>
            </div>
        </form>
    </div>
</body>
</html>