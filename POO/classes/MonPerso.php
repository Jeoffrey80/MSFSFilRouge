<?php
//Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la classe Personnage
include 'Personnage.class.php';

// Créer un objet Personnage
$p = new Personnage();

// Définir les attributs du personnage
$p->setNom("Lebowski");
$p->setPrenom("Jeff");
$p->setAge(45);
$p->setSexe("Masculin");

// Afficher le personnage
echo $p;
?>
