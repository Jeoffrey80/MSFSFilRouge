<?php
class Employe {
    private $nom;
    private $prenom;
    private $age;
    private $dateemb;
    private $fonction;
    private $salaire;
    private $service;


//Constructeur
public function __construct($nom, $prenom, $age, $dateemb, $fonction, $salaire, $service)
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->age=$age;
        $this->dateemb=$dateemb;
        $this->fonction=$fonction;
        $this->salaire=$salaire;
        $this->service=$service;
}

