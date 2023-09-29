<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$articles = json_encode($_SESSION['panier']); // Convertir le panier en JSON
$montant_total = isset($_SESSION['montant_total']) ? $_SESSION['montant_total'] : 0;

// ... Autres vérifications et validations ...

// Préparer la requête SQL d'insertion
$sql = "INSERT INTO totmail (nom, email, telephone, adresse, articles, montant_total) VALUES (:nom, :email, :telephone, :adresse, :articles, :montant_total)";

// Préparer la requête et l'exécuter
$requete = $conn->prepare($sql);
$requete->bindParam(':nom', $nom);
$requete->bindParam(':email', $email);
$requete->bindParam(':telephone', $telephone);
$requete->bindParam(':adresse', $adresse);
$requete->bindParam(':articles', $articles);
$requete->bindParam(':montant_total', $montant_total);

if ($requete->execute()) {
    // La commande a été enregistrée avec succès dans la base de données
    // Vous pouvez ajouter ici d'autres actions, comme vider le panier, envoyer un e-mail de confirmation, etc.
    unset($_SESSION['panier']); // Vider le panier
    header ("location: index.php");
    exit();
} else {
    echo 'Une erreur s\'est produite lors de l\'enregistrement de la commande.';
}

?>