<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Assurez-vous d'ajuster le chemin si nécessaire

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer l'adresse e-mail saisie par l'utilisateur
    $userEmail = $_POST['email'];
    $message = $_POST['message'];

    // Configuration de PHPMailer pour Gmail
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'votre_adresse_email@gmail.com'; // Votre adresse Gmail complète
    $mail->Password = 'votre_mot_de_passe'; // Mot de passe de votre adresse Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Expéditeur et destinataire
    $mail->setFrom('votre_adresse_email@gmail.com', 'Votre Nom');
    $mail->addAddress($userEmail);

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Confirmation de votre message';
    $mail->Body = "Nous avons bien reçu votre message : <br><br>$message";

    try {
        $mail->send();
        echo "<p>Un e-mail de confirmation a été envoyé à $userEmail.</p>";
    } catch (Exception $e) {
        echo "<p>Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}</p>";
    }
}
?>
