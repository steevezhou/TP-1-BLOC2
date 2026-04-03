<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Serveur - Mini-Nagios</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f3f4f6;
            --surface: #ffffff;
            --text: #1f2937;
            --text-muted: #6b7280;
            --border: #d1d5db;
            --input-focus: #c7d2fe;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px; /* Plus étroit pour un formulaire, c'est plus élégant */
            background: var(--surface);
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover { color: var(--primary); }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text);
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            box-sizing: border-box;
            transition: all 0.2s ease;
            background-color: #f9fafb;
            color: #111827;
        }

        /* L'effet "Halo" bleu quand on clique sur un champ */
        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--input-focus);
            background-color: #ffffff;
        }

        input::placeholder { color: #9ca3af; }

        .btn-submit {
            width: 100%;
            padding: 12px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>🏭 Provisionner un Serveur</h2>
        <a href="index.php" class="back-link">← Retour au dashboard</a>
    </div>

    <form method="POST" action="traitementPersisteServeur.php">

        <div class="form-group">
            <label for="hostname">Nom d'hôte (Hostname) :</label>
            <input type="text" id="hostname" name="hostname" required placeholder="Ex: SRV-DB-02 (Lettres, chiffres, tirets)">
        </div>

        <div class="form-group">
            <label for="ip">Adresse IP :</label>
            <input type="text" id="ip" name="ip" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" title="Veuillez entrer une adresse IPv4 valide" placeholder="Ex: 192.168.1.50">
        </div>

        <div class="form-group">
            <label for="os">Système d'Exploitation :</label>
            <select id="os" name="os" required>
                <option value="" disabled selected>-- Sélectionnez un OS --</option>
                <optgroup label="Systèmes Autorisés">
                    <option value="Debian 12">Debian 12</option>
                    <option value="Ubuntu 24.04">Ubuntu 24.04</option>
                    <option value="Windows Server 2022">Windows Server 2022</option>
                    <option value="RedHat 9">RedHat 9</option>
                </optgroup>
                <optgroup label="Systèmes Non Supportés">
                    <option value="Windows XP">Windows XP (Interdit)</option>
                    <option value="TempleOS">TempleOS (Interdit)</option>
                </optgroup>
            </select>
        </div>

        <button type="submit" class="btn-submit">✅ Créer le serveur</button>
    </form>
</div>

</body>
</html>