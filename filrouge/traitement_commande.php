<?php
session_start();

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
// Récupérer d'autres données du formulaire

// Récupérer les détails de la commande depuis le champ caché
$detailsCommande = $_POST['detailsCommande'];

// ... Autres traitements ...

// Envoyer un e-mail à l'utilisateur avec les détails de la commande
$subject = "Détails de votre commande";
$message = "Bonjour $nom,\n\nVoici les détails de votre commande :\n\n$detailsCommande";
$headers = "From: noreply@thedistrict.com";

// Envoyer l'e-mail
mail($email, $subject, $message, $headers);

// Rediriger vers une page de confirmation
header("Location: index.php");
exit();
?>
