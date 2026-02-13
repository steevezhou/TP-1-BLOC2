<?php
// 1. Chargement automatique des classes (Grâce à Composer)
require '../vendor/autoload.php';

// Appel d'une méthode statique avec "::" (Les deux points Paamayim Nekudotayim)
// Pas de "new Validator()", c'est inutile !

$ipTest = "999.0.0.1";
if (App\Validator::isIpValid($ipTest)) {
    echo "IP Valide";
} else {
    echo "IP Invalide (Sécurité activée)";
}

// 2. Importation des classes qu'on veut utiliser
use App\Serveur;
use App\Routeur;
use App\Imprimante;

// 3. Instanciation des objets
// On crée des objets concrets avec le mot clé "new"
$monServeurWeb = new Serveur("SRV-WEB-01", "192.168.1.10", "Debian 12");
$monServeurAD  = new Serveur("SRV-AD-01", "192.168.1.11", "Windows Server 2022");
$monRouteur    = new Routeur("RTR-CORE", "10.0.0.1", 24);

$monImprimant = new Imprimante("192.168.1.50", "HP-Etage-1", "Laser", false);
$monImprimant2 = new Imprimante("192.168.1.60", "Canon-Direction", "Jet d'encre", true);

// 4. Utilisation des objets
echo "<h1>Tableau de bord Mini-Nagios</h1>";

echo "<p>" . $monServeurWeb->afficherStatut() . "</p>";
echo "<p>" . $monServeurAD->afficherStatut() . "</p>";
echo "<p>" . $monRouteur->afficherStatut() . "</p>";
echo "<p>" . $monImprimant->afficherStatut() . "</p>";
echo "<p>" . $monImprimant2->afficherStatut() . "</p>";
// debug pour voler la structure réelle de l'objet
echo "<pre>";
var_dump($monImprimant);
echo "<pre>";