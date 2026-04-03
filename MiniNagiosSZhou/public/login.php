<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Espace Personnel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #111827;
        }

        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
        }

        .header p {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 8px;
        }

        .error-message {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 20px;
            border: 1px solid #f87171;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            fill: #9ca3af;
        }

        .form-control {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            color: #111827;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 0.875rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 10px 15px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .footer-links {
            margin-top: 25px;
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .footer-links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="header">
        <h1>Espace de connexion</h1>
        <p>Veuillez saisir vos identifiants pour continuer.</p>
    </div>

    <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1): ?>
        <div class="error-message">
            Identifiants incorrects. Veuillez réessayer.
        </div>
    <?php endif; ?>

    <form action="traitement_login.php" method="POST">
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24"><path d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/></svg>
                <input type="email" id="email" name="email" class="form-control" placeholder="prenom.nom@gmail.com" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24"><path d="M12.65 10A5.99 5.99 0 007 6c-3.31 0-6 2.69-6 6s2.69 6 6 6a5.99 5.99 0 005.65-4H17v2h2v-2h2v-2h-8.35zM7 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm11-6h2v2h-2v-2z"/></svg>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <a href="#" class="forgot-password">Mot de passe oublié ?</a>

        <button type="submit" class="btn-submit">Se connecter</button>
    </form>

    <div class="footer-links">
        Vous n'avez pas de compte ? <a href="#">Créer un compte en cliquant ici</a>
    </div>
</div>

</body>
</html>