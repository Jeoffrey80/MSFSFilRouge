<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plats Asiatiques</title>
    <style>
        .ulplats {
            list-style: none;
            padding: 0;
        }

        .liplats {
            display: flex;
            margin-bottom: 20px;
        }

        .liplats img {
            width: 150px;
            height: 150px;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<section id="Asiatique">
        <h2>Plats Asiatiques</h2>
        <form action="enregistrer_commande.php" method="post">
            <ul class="ulplats">
                <li class="liplats">
                    <img src="images_the_disctrict/food/Plats/asiat1.jpg" class="imgcommande" alt="Image 1">
                    <div>
                        <h3>Sushi</h3>
                        <p>Sushi au saumon 2 pièces</p>
                        <p>Prix : 4.99€</p>
                        <label for="quantiteSushi">Quantité :</label>
                        <input type="number" name="quantiteSushi" id="quantiteSushi" min="0" value="0">
                    </div>
                </li>
                <li class="liplats">
                    <img src="images_the_disctrict/food/Plats/asiat2.jpeg" class="imgcommande" alt="Image 2">
                    <div>
                        <h3>Maki</h3>
                        <p>Maki 6 pièces</p>
                        <p>Prix : 29.99€</p>
                        <label for="quantiteMaki">Quantité :</label>
                        <input type="number" name="quantiteMaki" id="quantiteMaki" min="0" value="0">
                    </div>
                </li>
                <li class="liplats">
                    <img src="images_the_disctrict/food/Plats/asiat3.jpeg" class="imgcommande" alt="Image 3">
                    <div>
                        <h3>Yakitori</h3>
                        <p>Brochette de bœuf avec fromage fondu à l'intérieur 3 pièces</p>
                        <p>Prix : 14.99€</p>
                        <label for="quantiteYakitori">Quantité :</label>
                        <input type="number" name="quantiteYakitori" id="quantiteYakitori" min="0" value="0">
                    </div>
                </li>
            </ul>
            <button type="submit">Ajouter au panier</button>
        </form>
    </section>

   