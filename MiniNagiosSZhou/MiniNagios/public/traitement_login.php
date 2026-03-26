<?php
// On démarre la session en tout premier
session_start();

// On vérifie que le formulaire a bien été soumis avec les champs attendus
if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Connexion à la base de données (Correction du dbname en 'mininagios')
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mininagios;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // 2. Chercher l'email dans la table administrateurs
    $stmt = $pdo->prepare('SELECT * FROM administrateurs WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3. Utiliser password_verify() avec le mot de passe saisi
    // CORRECTION ICI : On utilise $user['password_hash'] car c'est le nom de ta colonne
    if ($user && password_verify($password, $user['password_hash'])) {

        // 4. Si c'est OK : assignation de la session puis redirection vers dashboard.php
        $_SESSION['admin_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();

    } else {

        // 5. Si c'est KO : Redirection vers login.php?erreur=1
        header('Location: login.php?erreur=1');
        exit();

    }

} else {
    // Si on essaie d'accéder au script directement sans envoyer de POST
    header('Location: login.php');
    exit();
}