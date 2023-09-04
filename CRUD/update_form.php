<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Disque</title>
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

                // Requête SQL pour récupérer la liste des artistes
                $sqlArtists = "SELECT artist_id, artist_name FROM artist";
                $resultArtists = $conn->query($sqlArtists);

                // Formulaire de mise à jour
                echo '<h1>Modifier le Disque</h1>';
                echo '<form action="update_script.php" method="POST" enctype="multipart/form-data">';
                echo '<input type="hidden" name="disc_id" value="' . $disc_id . '">';
                echo '<div class="form-group">';
                echo '<label for="titre">Titre :</label>';
                echo '<input type="text" class="form-control" id="titre" name="titre" value="' . $titre . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="annee">Année :</label>';
                echo '<input type="text" class="form-control" id="annee" name="annee" value="' . $annee . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="genre">Genre :</label>';
                echo '<input type="text" class="form-control" id="genre" name="genre" value="' . $genre . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="label">Label :</label>';
                echo '<input type="text" class="form-control" id="label" name="label" value="' . $label . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="prix">Prix :</label>';
                echo '<input type="text" class="form-control" id="prix" name="prix" value="' . $prix . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="artiste">Artiste :</label>';
                echo '<select class="form-control" id="artiste" name="artiste">';
                
                // Boucle pour construire la liste déroulante des artistes
                while ($rowArtist = $resultArtists->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($rowArtist['artist_id'] == $artist_id) ? "selected" : "";
                    echo '<option value="' . $rowArtist['artist_id'] . '" ' . $selected . '>' . $rowArtist['artist_name'] . '</option>';
                }

                echo '</select>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="image">Image :</label>';
                echo '<input type="file" class="form-control-file" id="image" name="image">';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Enregistrer</button>';
                echo '<a class="btn btn-secondary" href="index.php">Retour</a>';
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
