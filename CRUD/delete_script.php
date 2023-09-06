<?php
// Inclure le fichier de connexion à la base de données
include("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["disc_id"])) {
    $disc_id = $_POST["disc_id"];

    // Requête SQL pour supprimer le disque avec l'ID spécifié
    $sql = "DELETE FROM disc WHERE disc_id = :disc_id";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":disc_id", $disc_id);
        $stmt->execute();

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
