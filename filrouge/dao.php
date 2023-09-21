<?php

function get_plats($host, $dbname, $username, $password)
{
    $carouselHtml = '';

    try {
        // Connexion à la base de données MySQL
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Exécutez la requête SQL
        $stmt = $db->query("SELECT p.image, p.libelle, SUM(c.quantite) AS total_quantite
                            FROM commande c
                            INNER JOIN plat p ON c.id_plat = p.id
                            GROUP BY c.id_plat
                            ORDER BY total_quantite DESC
                            LIMIT 6");
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Variable pour suivre l'index du carrousel
        $index = 0;

        // Parcourez et ajoutez les éléments au carrousel
        foreach ($resultats as $resultat) {
            $image = $resultat['image'];
            $libelle = $resultat['libelle'];
            $totalQuantite = $resultat['total_quantite'];

            // Définissez la classe active pour le premier élément
            $activeClass = ($index === 0) ? 'active' : '';

            $carouselHtml .= '<div class="carousel-item ' . $activeClass . '">';
            $carouselHtml .= '<img src="' . $image . '" class="d-block w-100 custom-carousel-image" alt="Image du plat">';
            $carouselHtml .= '<div class="carousel-caption">';
            $carouselHtml .= '<h3>' . $libelle . '</h3>';
            $carouselHtml .= '<p>Total des ventes : ' . $totalQuantite . '</p>';
            $carouselHtml .= '</div>';
            $carouselHtml .= '</div>';

            // Incrémentez l'index
            $index++;
        }
    } catch (PDOException $e) {
        $carouselHtml = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    return $carouselHtml;
}
?>