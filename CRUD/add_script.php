<?php
// Inclure le fichier de connexion à la base de données
include("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $artisteNom = $_POST["artiste"];
    $annee = $_POST["annee"];
    $genre = $_POST["genre"];
    $label = $_POST["label"];
    $prix = $_POST["prix"];

    // Gestion de l'envoi de l'image
    $imagePath = "img/"; // Répertoire où l'image sera stockée
    $imageName = $_FILES["image"]["name"];
    $imageTempName = $_FILES["image"]["tmp_name"];
    $imageUploadPath = $imagePath . $imageName;

    // Déplacer l'image téléchargée vers le répertoire "img"
    move_uploaded_file($imageTempName, $imageUploadPath);

    try {
        if (empty($artisteNom)) {
            echo "Veuillez sélectionner un artiste.";
        } else {
            // Requête SQL pour obtenir l'ID de l'artiste en fonction de son nom
            $sqlArtisteId = "SELECT artist_id FROM artist WHERE artist_name = :artisteNom";
            $stmtArtisteId = $conn->prepare($sqlArtisteId);
            $stmtArtisteId->bindParam(":artisteNom", $artisteNom);
            $stmtArtisteId->execute();
            $rowArtisteId = $stmtArtisteId->fetch(PDO::FETCH_ASSOC);
            $artisteId = $rowArtisteId["artist_id"];

            // Requête SQL pour insérer les données dans la table "disc" avec l'ID de l'artiste
            $sql = "INSERT INTO disc (disc_title, artist_id, disc_year, disc_genre, disc_label, disc_price, disc_picture) VALUES (:titre, :artisteId, :annee, :genre, :label, :prix, :image)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":titre", $titre);
            $stmt->bindParam(":artisteId", $artisteId);
            $stmt->bindParam(":annee", $annee);
            $stmt->bindParam(":genre", $genre);
            $stmt->bindParam(":label", $label);
            $stmt->bindParam(":prix", $prix);
            $stmt->bindParam(":image", $imageName);
            $stmt->execute();
            
            // Rediriger vers la page index.php après l'ajout
            header("Location: index.php");
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
