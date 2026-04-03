<?php
// On inclut l'autoloader de Composer (s'il fonctionne)
require_once __DIR__ . '/../vendor/autoload.php';

// 1. Le Gardien du Temple vérifie l'accès
App\Securite::verifierConnexion();

// 2. Importation des classes
use App\Database;
use App\ServeurRepository;

// 3. Récupération des données pour le dashboard
$monPDO = Database::getConnection();
$monRepository = new ServeurRepository($monPDO);
$monTableauServeurs = $monRepository->ListerTous();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Mini-Nagios</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --bg: #f3f4f6;
            --surface: #ffffff;
            --text: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            background: var(--surface);
            padding: 30px;
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

        h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-weight: 500;
            border: 1px solid #a7f3d0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            text-decoration: none;
            color: white;
            background: var(--primary);
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background: var(--danger);
            padding: 8px 12px;
            font-size: 0.8rem;
        }

        .btn-danger:hover { background: var(--danger-hover); }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        tr { transition: background-color 0.15s ease; }
        tr:hover td { background-color: #f9fafb; }

        .ip-address {
            font-family: monospace;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            font-size: 0.875rem;
            color: #374151;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .empty-state {
            text-align: center;
            padding: 48px !important;
            color: var(--text-muted);
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>🖥️ Dashboard Serveurs</h1>
        <a href="ajouter_machine.php" class="btn">➕ Ajouter un serveur</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert-success">
            ✅ Opération réalisée avec succès !
        </div>
    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Hostname</th>
            <th>IP</th>
            <th>OS</th>
            <th>Date d'ajout</th>
            <th style="text-align: right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($monTableauServeurs)): ?>
            <tr>
                <td colspan="6" class="empty-state">📭 Aucun serveur n'est actuellement enregistré dans la base.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($monTableauServeurs as $srv): ?>
                <tr>
                    <td style="color: var(--text-muted); font-weight: 500;">#<?= htmlspecialchars($srv['id']) ?></td>
                    <td style="font-weight: 600; color: #111827;"><?= htmlspecialchars($srv['hostname']) ?></td>
                    <td><span class="ip-address"><?= htmlspecialchars($srv['ip']) ?></span></td>
                    <td><span class="badge"><?= htmlspecialchars($srv['os']) ?></span></td>
                    <td style="color: var(--text-muted); font-size: 0.875rem;"><?= htmlspecialchars($srv['date_creation']) ?></td>
                    <td style="text-align: right;">
                        <a href="supprimer.php?id=<?= $srv['id'] ?>"
                           class="btn btn-danger"
                           onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer le serveur <?= htmlspecialchars(addslashes($srv['hostname'])) ?> ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>