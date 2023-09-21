<!doctype html>
<html lang="fr-fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The District: <?= $title ?></title>
    <link rel="stylesheet" href="dist/assets/index.css">
    <link rel="shortcut icon" href="images_the_disctrict/the_district_brand/favicon.png" />
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

<body>
<header><!--Début du header pour la partie Layout(entete) -->
      <nav class=" navbar navbar-expand-lg bg-danger rounded custom-rounded couleur-navigation"><!--Début de la NavBar Bootstrap-->
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img class="logo" src="images_the_disctrict/the_district_brand/logo.png"
              alt="logo" title="logo"></a>
          <ul class="col-3 nav-link couleurtitre fs-1"><u><b><a href="index.php" style="color:white;"> The District</a></b></u></ul>
          <button class="navbar-toggler col-btn" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-primary"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link custom-heading active fs-1" aria-current="page"
                  href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-heading active fs-1" href="Categorie.php">Catégorie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-heading active fs-1" href="Contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-heading active fs-1" href="plat.php">Plats</a>
              </li>
        </ul>
            <ul class="ml-auto">
              <form class="d-flex justify-content-right align-items-center " role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success color-search" type="submit">Rechercher</button>
              </form>
              <br>
              <form action="deconnexion.php" method="post">
                <button class="btn btn-outline-success color-search" type="submit">Déconnexion</button>
              </form>

            </ul>

          </div>
        </div>
      </nav><!--Fin de la NavBar-->
</script>   
