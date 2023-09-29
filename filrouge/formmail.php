<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Inclusion de la feuille de style Bootstrap depuis un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Inclusion de la feuille de style personnalisée "style.css" -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
<?php
// Inclusion du fichier d'en-tête PHP
include('header.php')
?>

<section class="cc-menu merriweather py-5 centered-form"> 
    <form id="monFormulaire" action="traitcommande.php" method="post">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Nom et Prenom :</label>
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="nom" name="nom"
                        placeholder="Votre Nom et Prenom:" >
                    <div class="text-red">Ce champ est obligatoire</div>
                </div>
            </div>
        </div>
    
    <br>
    
    <div class="row g-5">
        <!-- Colonne 1 (Email) -->
        <div class="col">
            <label for="exampleFormControlInput3" class="form-label" >Email :</label>
            <input type="email" class="form-control"  id="email" name="email" placeholder="example@gmail.com :" >
            <div class="text-red">Ce champ est obligatoire</div>
        </div>
        <!-- Colonne 2 (Téléphone) -->
        <div class="col">
            <label for="exampleFormControlInput2" class="form-label">Téléphone :</label>
            <input type="text" class="form-control"  id="tel" name="telephone" placeholder="0123456789 :" >
            <div class="text-red">Ce champ est obligatoire</div>
        </div>
    </div>
    </div>
    
    <br>
    
    <!-- Colonne unique (Adresse) -->
    <div class="col-12">
        <div class="form-group">
          <label for="exampleFormControlInput4" class="form-label">Votre adresse :</label>
          <div class="input-wrapper">
            <input type="text" class="form-control custom-height" id="adresse" name="adresse" placeholder="Votre adresse :" >
            <div class="text-red">Ce champ est obligatoire</div>
          </div>
        </div>
    </div>
    
    <br>
    
    <!-- Bouton de paiement -->
    <div class="container-fluid">
        <div class="text-end">
        <button class="btn btn-primary" type="submit">Payer</button>
        </div>
    </div>
    </form>
</section>

<!-- Inclusion du fichier de pied de page PHP -->
<?php
include('footer.php')
?>

<!-- Inclusion du script JavaScript "formulaire.js" -->
<script src="form.js"></script>
</body>
</html>