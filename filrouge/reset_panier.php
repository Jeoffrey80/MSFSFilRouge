<?php
session_start();

// Réinitialiser le panier (le vider)
$_SESSION['panier'] = array();

// Rediriger vers la page des plats (ou toute autre page que vous souhaitez après la réinitialisation)
header("Location: plat.php");
exit();
?>
