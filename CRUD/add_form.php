<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Vinyle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Vinyle</h1>
        <form action="add_script.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre de la Musique :</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="artiste">Nom de l'artiste ou du groupe :</label>
                <select class="form-control" id="artiste" name="artiste" required>
                    <option value="">Sélectionnez un artiste</option>
                    <?php
                    // Inclure le fichier de connexion à la base de données
                    include("connexiondb.php");

                    // Requête SQL pour récupérer la liste des noms d'artistes
                    $sqlArtiste = "SELECT artist_name FROM artist";
                    $resultArtiste = $conn->query($sqlArtiste);

                    if ($resultArtiste->rowCount() > 0) {
                        while ($rowArtiste = $resultArtiste->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $rowArtiste['artist_name'] . '">' . $rowArtiste['artist_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="annee">Année :</label>
                <input type="text" class="form-control" id="annee" name="annee" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre :</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="label">Label :</label>
                <input type="text" class="form-control" id="label" name="label" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
