<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = "Un lien de réinitialisation a été envoyé à votre adresse e-mail (simulation).";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié - Gestion Pharmacie</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
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
        .login-container input {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }
        .login-container input:focus {
            border-color: #2c5364;
            outline: none;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #2c5364;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }
        .login-container button:hover {
            background-color: #1b2a36;
        }
        .login-container .links {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-container .links a {
            color: #2c5364;
            text-decoration: none;
            margin: 0 5px;
        }
        .login-container .links a:hover {
            text-decoration: underline;
        }
        .message {
            color: green;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="post" action="">
            <h2>Réinitialiser le mot de passe</h2>
            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <button type="submit">Envoyer le lien</button>

            <div class="links">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>
