<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$session_status = session_status();
require 'filrouge/dao.php';
$carouselContent = get_plats('localhost', 'district', 'jeoffrey', 'jojo123');
if ($session_status == PHP_SESSION_ACTIVE) {
    echo "Une session est active.";
} elseif ($session_status == PHP_SESSION_NONE) {
    echo "Aucune session n'est active, mais les sessions sont activées.";
} elseif ($session_status == PHP_SESSION_DISABLED) {
    echo "Les sessions sont désactivées.";
}
$nomuser=$_SESSION['pseudo'];
// Vérifier si l'utilisateur n'est pas connecté
if (!isset($_SESSION['pseudo'])) {
  // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
  header("Location: connexion.php");
  exit();
}
$title = "Accueil";
?>
  <div class="parallax-bg">
      <header><!--Début du header pour la partie Layout(entete) -->
        <?php include 'header.php';
        echo "Bienvenue à toi ".$nomuser." !";?>
    </header><!--Fin du header pour la partie Layout(entete) -->
    <body>
    <main class="mt-auto">
      <br><br>
      <!-- <div class=" video-container d-flex justify-content-center couleur-navigation">
        <video id="myVideo" class="d-block video" width="900" height="450" autoplay muted controls loop>
          <source src="video/pizza_-_176 (360p).mp4" type="video/mp4">
          Votre navigateur ne prend pas en charge la lecture de vidéos HTML5.
        </video>

      </div> -->
      <br><br>
      <div class="d-flex justify-content-center couleur-navigation"><!--Début de la partie Carousel-->
        &nbsp;
        <div class="row">
          <div class="col-12">
            <div id="carouselaccueil" class="carousel slide" data-bs-ride="carousel" data-interval="2000">
              <div class="carousel-inner">
                <div class="carouselmedia carousel-item active">
                  <img src="images_the_disctrict/bg.jpg" class="d-block" alt="..." style="width:900px;height:450px;">
                </div>
                <div class="carouselmedia carousel-item">
                  <img src="images_the_disctrict/bg1.jpeg" class="d-block" alt="..." style="width:900px;height:450px;">
                </div>
                <div class="carouselmedia carousel-item">
                  <img src="images_the_disctrict/bg2.jpeg" class="d-block" alt="..." style="width:900px;height:450px;">
                </div>
                <div class="carouselmedia carousel-item">
                  <img src="images_the_disctrict/bg3.jpeg" class="d-block" alt="..." style="width:900px;height:450px;">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--Fin de la partie Carousel-->
      <br>
      <button class="navbar-toggler col-btn" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-primary"></span>
      </button>
      <div class="taillelogoaccueil d-flex justify-content-center align-items-center couleur-navigation carousel-item">
        <!--Corps de la page avec le slogan ainsi que quelques images-->
        <ul class="nav-link couleurslogan "><u class="fs-1 taillelogoaccueil"><b>Large choix sur vos produits ! </b></u>
          <p class="fs-4 taillelogoaccueil">Bienvenue dans l'ère culinaire de The District :</p>
          <p>une fusion exquise de saveurs rapides et de satisfaction gourmande,
            où chaque bouchée vous transporte vers un monde de délices.</p>
        </ul>
        <a class="taillelogoaccueil mx-5"><img src="images_the_disctrict/burger.jpg" class="d-block"
            alt="..." style="width:250px;height:250px;"></a>&nbsp;
        <a class=" taillelogoaccueil mx-5"><img src="images_the_disctrict/pizza.jpg" class="d-block"
            alt="..." style="width:250px;height:250px;"></a>&nbsp;
      </div><!--Corps de la page avec le slogan ainsi que quelques images-->
  </div>
  <div class="row bg-light">
		    <div class="card my-5 border-0 rounded-0">
	<div class="row">
	<div class="col-md-6">
  <div id="platsCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicateurs -->
                <ol class="carousel-indicators">
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="1"></li>
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="2"></li>
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="3"></li>
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="4"></li>
                    <li data-bs-target="#platsCarousel" data-bs-slide-to="5"></li>
                    <!-- Ajoutez autant d'indicateurs que nécessaire -->
                </ol>

                <!-- Slides du carrousel -->
                <div class="carousel-inner">
				<?php echo $carouselContent; ?> 
                </div>
                <!-- Contrôles du carrousel -->
                <a class="carousel-control-prev" href="#platsCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#platsCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
</div>
</main> 
</body>
<footer class="footer fixed-bottom"><!-- Début du pied de page avec les réseaux sociaux -->
  <?php include 'footer.php';?>
</footer>
</html>