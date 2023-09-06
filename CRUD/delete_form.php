<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer le Disque</title>
    <!-- Ajouter la référence au fichier Bootstrap CSS (à télécharger ou à partir d'un CDN) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Inclure le fichier de connexion à la base de données
    include("connexiondb.php");

    // Vérifier si l'ID du disque est spécifié dans l'URL
    if (isset($_GET['disc_id'])) {
        $disc_id = $_GET['disc_id'];

        // Requête SQL pour récupérer les détails du disque
        $sql = "SELECT disc_title FROM disc WHERE disc_id = :disc_id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":disc_id", $disc_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $titre = $row['disc_title'];

                echo '<h1>Supprimer le Disque</h1>';
                echo '<p>Êtes-vous sûr de vouloir supprimer le disque "' . $titre . '" ?</p>';
                echo '<form action="delete_script.php" method="POST">';
                echo '<input type="hidden" name="disc_id" value="' . $disc_id . '">';
                echo '<button type="submit" class="btn btn-danger">Supprimer</button>';
                echo '<a class="btn btn-secondary" href="detail.php?disc_id=' . $disc_id . '">Annuler</a>';
                echo '</form>';
            } else {
                echo "Aucun enregistrement trouvé pour cet ID de disque.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "ID de disque non spécifié.";
    }

    // Fermeture de la connexion à la base de données
    $conn = null;
    ?>
    <!-- Ajouter la référence au fichier Bootstrap JavaScript (facultatif si vous n'utilisez pas les fonctionnalités JavaScript de Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
