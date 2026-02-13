<?php

namespace App;

class Imprimante extends EquipementReseau
{
    private string $type;
    private bool $estCouleur;

    public function __construct(string $hostname, string $ip, string $type, bool $estCouleur)
    {
        if (!Validator::isHostnameValid($ip)) {
            throw new \Exception("Le hostname '$hostname' est invalide (pas d'espaces, pas d'accents).");

            parent::__construct($ip, $hostname);
            $this->type = $type;
            $this->estCouleur = $estCouleur;
        }
    }

    public function afficherStatut(): String
    {
        $couleurTexte = $this->estCouleur ? "OUI" : "NON";
        return "Équipement : {$this->hostname} ({$this->ip}) | Type : {$this->type} | Couleur : {$couleurTexte}";
    }

}