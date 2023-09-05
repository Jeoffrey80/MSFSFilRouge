<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Disque</title>
    <!-- Ajouter la référence au fichier Bootstrap CSS (à télécharger ou à partir d'un CDN) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Ajoutez du CSS pour mettre en forme les éléments */
        .disque {
            display: flex;
            align-items: center;
        }
        .disque img {
            max-width: 25%; /* Pour réduire la taille de l'image */
            height: auto;
        }
        .details {
            flex-grow: 1;
            padding: 0 20px; /* Espacement entre l'image et les détails */
        }
    </style>
</head>
<body>
    <?php
    // Inclure le fichier de connexion à la base de données
    include("connexiondb.php");

    // Vérifier si l'ID du disque est spécifié dans l'URL
    if (isset($_GET['disc_id'])) {
        $disc_id = $_GET['disc_id'];

        // Requête SQL pour récupérer les détails du disque
        $sql = "SELECT disc_title, disc_year, disc_picture, disc_genre, disc_label, disc_price, artist_id FROM disc WHERE disc_id = :disc_id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":disc_id", $disc_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $titre = $row['disc_title'];
                $annee = $row['disc_year'];
                $image = $row['disc_picture'];
                $genre = $row['disc_genre'];
                $label = $row['disc_label'];
                $prix = $row['disc_price'];
                $artist_id = $row['artist_id'];

                // Requête SQL pour récupérer le nom de l'artiste
                $sqlArtiste = "SELECT artist_name FROM artist WHERE artist_id = :artist_id";
                $stmtArtiste = $conn->prepare($sqlArtiste);
                $stmtArtiste->bindParam(":artist_id", $artist_id);
                $stmtArtiste->execute();
                
                if ($stmtArtiste->rowCount() > 0) {
                    $rowArtiste = $stmtArtiste->fetch(PDO::FETCH_ASSOC);
                    $artiste = $rowArtiste['artist_name'];
                } else {
                    $artiste = "Artiste inconnu";
                }

                echo '<h1>Détails du Disque</h1>';
                echo '<div class="disque">';
                echo '<img src="img/' . $image . '" alt="Image du disque">';
                echo '<div class="details">';
                echo '<b>' . $titre . '</b>';
                echo '<p>Artiste : ' . $artiste . '</p>';
                echo '<p>Année : ' . $annee . '</p>';
                echo '<p>Genre : ' . $genre . '</p>';
                echo '<p>Label : ' . $label . '</p>';
                echo '<p>Prix : $' . $prix . '</p>'; // Affichage du prix
                echo '<a class="btn btn-primary" href="update_form.php?disc_id=' . $disc_id . '">Modifier</a>';
                echo '<a class="btn btn-danger" href="delete_script.php?disc_id=' . $disc_id . '">Supprimer</a>'; // Lien de suppression
                echo '<a class="btn btn-secondary" href="index.php">Retour</a>';
                echo '</div>';
                echo '</div>';
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
