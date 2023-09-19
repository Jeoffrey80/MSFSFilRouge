<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers une page d'accueil ou une autre page appropriée
header("Location: connexion.php");
exit();
?>
