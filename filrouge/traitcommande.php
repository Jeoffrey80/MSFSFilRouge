<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
$servername = "localhost";
$username = "lavallee";
$password = "Admin1234";
$dbname = "lavallee";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
require_once 'Panier.php';

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

// Créer une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP pour Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    // Votre adresse Gmail et mot de passe
    $mail->Username = 'distrcitdistrict@gmail.com';
    $mail->Password = 'ggkp nkjm plmo kpwd';

    // Destinataire de l'e-mail
    $mail->setFrom('distrcitdistrict@gmail.com', 'Jeoffrey');
    $mail->addAddress($email, $nom); // Ajouter l'adresse du destinataire
    $mail->isHTML(true); // Activer le support HTML

    // Sujet et corps de l'e-mail
    $mail->Subject = 'Confirmation de commande';
    $mail->Body = 'Cher ' . $nom . ',<br><br>';
    $mail->Body .= 'Votre commande a été enregistrée avec succès. Merci de votre achat !<br><br>';
    foreach ($_SESSION['panier'] as $plat_id => $quantite) {
        $plat = getDetailsPlat($db, $plat_id);

        if ($plat) {
            $mail->Body .= 'Nom de l\'article : ' . $plat['libelle'] . '<br>';
            $mail->Body .= 'Quantité : ' . $quantite . '<br>';
            $mail->Body .= 'Prix unitaire : $' . $plat['prix'] . '<br>';
            $mail->Body .= 'Sous-total : $' . ($quantite * $plat['prix']) . '<br><br>';
        }
    }
    $mail->Body .= 'Montant total de la commande : $' . $montant_total . '<br><br>';
    $mail->Body .= 'Cordialement,<br>Votre Nom';

    // Envoyer l'e-mail
    $mail->send();
    unset($_SESSION['panier']); // Effacer le panier après l'envoi
    echo 'E-mail envoyé avec succès !';
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage();
}
?>