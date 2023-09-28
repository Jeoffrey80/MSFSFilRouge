<!-- index.html -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
</head>
<body>

<h2>Formulaire de Contact</h2>

<form action="envoyer_email.php" method="post">
    <label for="email">Adresse E-mail :</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <input type="submit" value="Valider" name="submit">
</form>

</body>
</html>

