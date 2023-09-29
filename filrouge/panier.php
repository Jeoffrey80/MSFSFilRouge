<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Vérifier si le panier existe dans la session
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Vérifier si les clés existent dans $_POST
$id_plat = isset($_POST['id_plat']) ? $_POST['id_plat'] : null;
$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : null;

if ($id_plat !== null && $quantite !== null) {
    // Supprimer le plat du panier si la quantité est de 0
    if ($quantite === '0') {
        unset($_SESSION['panier'][$id_plat]);
    } else {
        // Ajouter le plat au panier
        if (isset($_SESSION['panier'][$id_plat])) {
            $_SESSION['panier'][$id_plat] += $quantite;
        } else {
            $_SESSION['panier'][$id_plat] = $quantite;
        }
    }
}

// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';

// Fonction pour récupérer les détails d'un plat par son ID
function getDetailsPlat($conn, $id_plat) {
    $requete_plat = $conn->prepare("SELECT * FROM plat WHERE id = :id_plat");
    $requete_plat->bindParam(':id_plat', $id_plat);
    $requete_plat->execute();
    return $requete_plat->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <!-- Ajouter les liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Votre Panier</h1>

    <?php
    if (empty($_SESSION['panier'])) {
        echo '<p>Votre panier est vide.</p>';
        echo '<a href="plat.php" class="btn btn-primary">Retourner aux plats</a>';
    } else {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Image</th>';
        echo '<th>Plat</th>';
        echo '<th>Description</th>';
        echo '<th>Prix</th>';
        echo '<th>Quantité</th>';
        echo '<th>Total</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $total_panier = 0;

        foreach ($_SESSION['panier'] as $plat_id => $quantite) {
            $plat = getDetailsPlat($conn, $plat_id);

            if ($plat) {
                $total_plat = $quantite * $plat['prix'];
                $total_panier += $total_plat;

                echo '<tr>';
                echo '<td><img src="' . $plat['image'] . '" alt="Image Plat" style="max-width: 100px;"></td>';
                echo '<td>' . $plat['libelle'] . '</td>';
                echo '<td>' . $plat['description'] . '</td>';
                echo '<td>$' . $plat['prix'] . '</td>';
                echo '<td>' . $quantite . '</td>';
                echo '<td>$' . $total_plat . '</td>';
                echo '</tr>';
            }
        }

        $_SESSION['montant_total'] = $total_panier;

        echo '</tbody>';
        echo '</table>';

        echo '<h3>Total du Panier : $' . $total_panier . '</h3>';

        // Ajouter le bouton "Retourner aux plats"
        echo '<a href="plat.php" class="btn btn-primary">Retourner aux plats</a>';

        // Ajouter le bouton "Réinitialiser la commande"
        echo '<a href="reset_panier.php" class="btn btn-danger">Réinitialiser la commande</a>';

        //Ajouter le bouton "Finaliser la commande"
        echo '<a href="formmail.php" class="btn btn-success">Finaliser la commande</a>';
    }
    ?>
</div>

<!-- Ajouter les scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
