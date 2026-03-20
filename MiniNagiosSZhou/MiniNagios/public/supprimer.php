<?php
require '../vendor/autoload.php';

use MiniNagios\src\Database;
use MiniNagios\src\ServeurRepository;

if (isset($_GET['id'])){

    $db = Database::getConnection();
    $serveurRepository = new ServeurRepository($db) ;

    $id = $_GET['id'] ;
    $serveurRepository->supprimerParId($id);
}
header('Location: dashboard.php');
exit;
