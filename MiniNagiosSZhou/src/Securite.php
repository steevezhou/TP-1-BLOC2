<?php

namespace App;

class Securite
{
    public static function verifierConnexion(): void
    {
        // 1. Démarrer la session si ce n'est pas déjà fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Vérifier si l'utilisateur est connecté (présence de l'admin_id en session)
        if (!isset($_SESSION['admin_id'])) {
            // 3. Si non connecté, on le jette vers la page de connexion
            header("Location: login.php");
            exit();
        }
    }
}