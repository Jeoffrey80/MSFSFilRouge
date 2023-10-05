<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    header("Location: connexion.php");
    exit();
}

// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';

// Récupérer l'ID de l'utilisateur à partir de son pseudo
$pseudo = $_SESSION['pseudo'];
$requete_utilisateur = $db->prepare("SELECT id FROM utilisateur WHERE pseudo = :pseudo");
$requete_utilisateur->bindParam(':pseudo', $pseudo);
$requete_utilisateur->execute();
$resultat_utilisateur = $requete_utilisateur->fetch(PDO::FETCH_ASSOC);

if (!$resultat_utilisateur) {
    die("Utilisateur introuvable.");
}

$utilisateur_id = $resultat_utilisateur['id'];

// Fonction pour récupérer les plats par catégorie
function getPlatsParCategorie($db, $categorie_id) {
    $requete_plats = $db->prepare("SELECT * FROM plat WHERE id_categorie = :categorie_id AND active = 'Yes'");
    $requete_plats->bindParam(':categorie_id', $categorie_id);
    $requete_plats->execute();
    return $requete_plats->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plats par Catégorie</title>
    <!-- Ajouter les liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <?php include 'header.php';?>
</head>
<body>

<div class="container mt-5">
    <h1>Bienvenue, <?php echo $_SESSION['pseudo']; ?></h1>

    <!-- Boucle pour afficher les plats par catégorie -->
    <?php
    // Récupérer les catégories
    $requete_categories = $db->prepare("SELECT * FROM categorie WHERE active = 'Yes'");
    $requete_categories->execute();
    $categories = $requete_categories->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $categorie) {
        echo '<div class="mt-4">';
        echo '<h2>' . $categorie['libelle'] . '</h2>';

        // Récupérer les plats par catégorie
        $plats = getPlatsParCategorie($db, $categorie['id']);

        // Afficher les plats
        echo '<div class="row">';
        foreach ($plats as $plat) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card h-100">';
            echo '<img src="' . $plat['image'] . '" class="card-img-top" alt="Image Plat">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $plat['libelle'] . '</h5>';
            echo '<p class="card-text">' . $plat['description'] . '</p>';
            echo '<p class="card-text">Prix : $' . $plat['prix'] . '</p>';
            echo '<form action="panier.php" method="post">';
            echo '<input type="hidden" name="id_plat" value="' . $plat['id'] . '">';
            echo '<div class="form-group">';
            echo '<label for="quantite' . $plat['id'] . '">Quantité :</label>';
            echo '<input type="number" name="quantite" id="quantite' . $plat['id'] . '" class="form-control" min="0" value="0">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter au panier</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>'; // Fin de la ligne
        echo '</div>'; // Fin de la catégorie
    }
    ?>
</div>

<!-- Ajouter les scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
<foot><!-- Début du pied de page avec les réseaux sociaux -->
  <?php include 'footer.php';?>
</foot>

<script>
    function ajouterPlatsAuPanier() {
        // Collecter les données pour chaque plat et les envoyer au panier.php
        var plats = [];

        <?php
            // Récupérer les plats
            foreach ($plats as $plat) {
                echo 'var quantite' . $plat['id'] . ' = parseInt(document.getElementById("quantite' . $plat['id'] . '").value, 10);';
                echo 'if (quantite' . $plat['id'] . ' > 0) {';
                echo 'plats.push({ id: ' . $plat['id'] . ', quantite: quantite' . $plat['id'] . ' });';
                echo '}';
            }
        ?>

        // Envoyer les données au panier.php
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'panier.php';

        for (var i = 0; i < plats.length; i++) {
            var inputIdPlat = document.createElement('input');
            inputIdPlat.type = 'hidden';
            inputIdPlat.name = 'id_plat[]';
            inputIdPlat.value = plats[i].id;

            var inputQuantite = document.createElement('input');
            inputQuantite.type = 'hidden';
            inputQuantite.name = 'quantite[]';
            inputQuantite.value = plats[i].quantite;

            form.appendChild(inputIdPlat);
            form.appendChild(inputQuantite);
        }

        document.body.appendChild(form);
        form.submit();
    }
</script>
</html>
