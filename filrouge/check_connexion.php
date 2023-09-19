<?php
session_start();

// Vérifier si le pseudo de l'utilisateur est défini dans la session (connecté)
if (isset($_SESSION['pseudo'])) {
    // L'utilisateur est connecté, il peut accéder à toutes les pages
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    echo "Redirection en cours..."; // Vérification
    exit();
}
?>
