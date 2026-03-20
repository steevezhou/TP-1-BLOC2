<?php

require "../vendor/autoload.php";

use App\Service;
use App\Serveur;

$serveurWeb = new Serveur("SRV-WEB-01", "192.168.1.1", "Debian");
$serviceApache = new Service("Apache", 80, true);
$serviceSSH = new Service("SSH", 22, false);

$serviceApache->demarrer();
$serveurWeb->ajouterService($serviceApache);
$serveurWeb->ajouterService($serviceSSH);

echo $serveurWeb->afficherStatut();
echo "<BR>" ;

$serveurBDD = new Serveur("SRV-DB-01", "10.0.210.1", "Windows Server 2022");

$serviceMySQL = new Service("MySQL", 3306, true);
$serviceMySQL->demarrer();
$serviceRDP = new Service("RDP", 3389, false);

$serveurBDD->ajouterService($serviceMySQL);
$serveurBDD->ajouterService($serviceRDP);
echo $serveurBDD->afficherStatut();