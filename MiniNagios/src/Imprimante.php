<?php

namespace App;

class Imprimante
{
    private string $type;
    private bool $estCouleur;

    public function __construct(string $hostname, string $ip)
    {
        $this->hostname = $hostname;
        $this->ip = $ip;
    }

    public function  __construct1(string $type, bool $estCouleur)
    {
        $this->type = $type;
        $this->estCouleur = $estCouleur;
    }

    public function afficherStatut(): String
    {
        return "Équipement : $this->hostname ($this->ip) $this->type $this->estCouleur";
    }

}