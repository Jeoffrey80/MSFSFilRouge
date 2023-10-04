<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';
require_once 'panier.php';

// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$articles = json_encode($_SESSION['panier']); // Convertir le panier en JSON
$montant_total = isset($_SESSION['montant_total']) ? $_SESSION['montant_total'] : 0;

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

    // Configurer PHPMailer pour envoyer un e-mail via MailHog
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'localhost'; // Adresse du serveur MailHog
    $mail->Port = 1025; // Port de MailHog (par défaut)
    $mail->SMTPAuth = false;

    // Destinataire de l'e-mail
    $mail->setFrom('lobby8244@gmail.com', 'Jeoffrey');
    $mail->addAddress($email, $nom); // Ajouter l'adresse du destinataire
    $mail->isHTML(true); // Activer le support HTML

    // Sujet et corps de l'e-mail
    $articles = $_SESSION['panier'];
    $mail->Subject = 'Confirmation de commande';
    $mail->Body    = 'Cher ' . $nom . ',<br><br>';
    $mail->Body    .= 'Votre commande a été enregistrée avec succès. Merci de votre achat !<br><br>';
    foreach ($_SESSION['panier'] as $plat_id => $quantite) {
        $plat = getDetailsPlat($conn, $plat_id);
    
        if ($plat) {
            $mail->Body .= 'Nom de l\'article : ' . $plat['libelle'] . '<br>';
            $mail->Body .= 'Quantité : ' . $quantite . '<br>';
            $mail->Body .= 'Prix unitaire : $' . $plat['prix'] . '<br>';
            $mail->Body .= 'Sous-total : $' . ($quantite * $plat['prix']) . '<br><br>';
        }
    }    $mail->Body    .= 'Montant total de la commande : $' . $montant_total . '<br><br>';
    $mail->Body    .= 'Cordialement,<br>Jeoffrey';

    if ($mail->send()) {
    unset($_SESSION['panier']); 
        echo 'E-mail envoyé avec succès !';
        header("Location: index.php");
    exit();
    } else {
        echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
    }

} else {
    echo 'Une erreur s\'est produite lors de l\'enregistrement de la commande.';
    
}


?>