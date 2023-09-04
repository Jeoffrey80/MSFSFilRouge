<?php
// Inclure le fichier de connexion à la base de données
include("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations transmises par le formulaire
    $disc_id = $_POST['disc_id'];
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $genre = $_POST['genre'];
    $label = $_POST['label'];
    $prix = $_POST['prix'];
    $artiste_id = $_POST['artiste'];

    // Requête SQL pour mettre à jour les données du disque
    $sql = "UPDATE disc SET disc_title = :titre, disc_year = :annee, disc_genre = :genre, disc_label = :label, disc_price = :prix, artist_id = :artiste WHERE disc_id = :disc_id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":disc_id", $disc_id);
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":annee", $annee);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":label", $label);
        $stmt->bindParam(":prix", $prix);
        $stmt->bindParam(":artiste", $artiste_id);
        $stmt->execute();

        // Vérification de la mise à jour de l'image
        if ($_FILES['image']['error'] == 0) {
            // Nom du fichier image
            $image_name = $_FILES['image']['name'];

            // Emplacement temporaire du fichier
            $image_tmp = $_FILES['image']['tmp_name'];

            // Déplacer l'image vers le dossier "img" avec le nom d'origine
            move_uploaded_file($image_tmp, "img/" . $image_name);

            // Requête SQL pour mettre à jour le nom de l'image dans la base de données
            $sqlUpdateImage = "UPDATE disc SET disc_picture = :image WHERE disc_id = :disc_id";
            $stmtUpdateImage = $conn->prepare($sqlUpdateImage);
            $stmtUpdateImage->bindParam(":image", $image_name);
            $stmtUpdateImage->bindParam(":disc_id", $disc_id);
            $stmtUpdateImage->execute();
        }

        // Redirection vers la page de liste
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
