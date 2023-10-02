<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';

// Inclure la bibliothèque PHPMailer
require 'vendor/autoload.php';

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

    // Envoi de l'e-mail de confirmation
    $mail = new PHPMailer;

    // Configurer le serveur SMTP (ici, je suppose que vous utilisez MailHog sur le port 1025)
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->Port = 1025;

    // Configurer l'expéditeur et le destinataire
    $mail->setFrom('votre@adresse.com', 'Votre nom');
    $mail->addAddress($email, $nom);

    // Contenu de l'e-mail
    $mail->Subject = 'Confirmation de commande';
    $mail->Body = 'Votre commande a été enregistrée avec succès. Voici le détail de votre commande : ' . $articles;

    if(!$mail->send()) {
        echo 'Erreur lors de l\'envoi du mail : ' . $mail->ErrorInfo;
    } else {
        echo 'E-mail de confirmation envoyé avec succès.';
    }

    unset($_SESSION['panier']); // Vider le panier
    header("location: index.php");
    exit();
} else {
    echo 'Une erreur s\'est produite lors de l\'enregistrement de la commande.';
}

?>
