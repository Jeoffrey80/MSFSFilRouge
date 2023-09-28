<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
</head>
<body>

<h2>Formulaire de Contact</h2>

<form action="" method="post">
    <label for="pseudo">Pseudo (8 caractères minimum, au moins une majuscule, une minuscule, un caractère spécial et une lettre) :</label>
    <input type="text" id="pseudo" name="pseudo" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
    <br><br>
    <label for="email">Adresse E-mail :</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <input type="submit" value="Valider" name="submit">
</form>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];

    // Vérifier l'adresse e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // E-mail valide
        $message = "Salut $pseudo, ça fonctionne !";
        $subject = "Confirmation de votre message";

        // Utiliser MailHog pour envoyer l'e-mail
        // Notez que vous devez adapter cette partie pour votre configuration MailHog
        $output = shell_exec("echo '$message' | mailhog send-email -f sender@example.com -t $email -s '$subject'");

        echo "<p>Un e-mail de confirmation a été envoyé à $email.</p>";
    } else {
        // E-mail non valide
        echo "<p>L'adresse e-mail n'est pas valide.</p>";
    }
}
?>

</body>
</html>
