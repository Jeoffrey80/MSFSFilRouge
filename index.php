<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Disques</title>
    <!-- Ajoutez la référence au fichier Bootstrap CSS (à télécharger ou à partir d'un CDN) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Ajoutez du CSS pour mettre en forme les éléments */
        .disque-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .disque {
            width: 48%; /* Pour afficher deux disques par ligne avec un petit espace entre eux */
            margin-bottom: 20px; /* Espacement entre les lignes de disques */
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

    // Requête SQL pour récupérer les enregistrements de la table "disc"
    $sql = "SELECT disc_id, disc_title, disc_year, disc_picture, disc_genre, disc_label FROM disc";

    try {
        $result = $conn->query($sql);

        // Vérification de la réussite de la requête
        if ($result->rowCount() > 0) {
            $count = 0;
            echo '<h1>Liste des Disques (' . $result->rowCount() . ' disques)</h1>';
            echo '<a class="btn btn-primary" href="add_form.php">Ajouter</a><hr>'; // Bouton Ajouter
            echo '<div class="disque-container">';
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="disque">';
                echo '<img src="img/' . $row['disc_picture'] . '" alt="Image du disque">';
                echo '<div class="details">';
                echo '<b>' . $row['disc_title'] . '</b>';
                echo '<p>Année : ' . $row['disc_year'] . '</p>';
                echo '<p>Genre : ' . $row['disc_genre'] . '</p>';
                echo '<p>Label : ' . $row['disc_label'] . '</p>';
                echo '<a class="btn btn-primary" href="detail.php?disc_id=' . $row['disc_id'] . '">Détail</a>'; // Bouton Détail
                echo '</div>';
                echo '</div>';
                $count++;
            }
            echo '</div>';
        } else {
            echo '<h1>Liste des Disques (0 disque)</h1>';
            echo "Aucun enregistrement trouvé dans la table 'disc'.";
        }
    } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
    }

    // Fermeture de la connexion à la base de données
    $conn = null;
    ?>
    <!-- Ajoutez la référence au fichier Bootstrap JavaScript (facultatif si vous n'utilisez pas les fonctionnalités JavaScript de Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
