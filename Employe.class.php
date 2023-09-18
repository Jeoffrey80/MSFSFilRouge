<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Employe {
    private $nom;
    private $prenom;
    private $age;
    private $dateemb;
    private $fonction;
    private $salaire;
    private $service;

    // Constructeur
    public function __construct($nom, $prenom, $age, $dateemb, $fonction, $salaire, $service) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->dateemb = $dateemb;
        $this->fonction = $fonction;
        $this->salaire = $salaire;
        $this->service = $service;
    }

    // Méthode pour calculer l'ancienneté
    public function calculerAnciennete() {
        // Obtenez la date actuelle
        $dateActuelle = new DateTime();

        // Convertissez la date d'embauche de la chaîne en objet DateTime
        $dateEmbauche = new DateTime($this->dateemb);

        // Calculez la différence entre la date actuelle et la date d'embauche
        $difference = $dateActuelle->diff($dateEmbauche);

        // Obtenez l'ancienneté en années, mois et jours
        $annees = $difference->y;
        $mois = $difference->m;
        $jours = $difference->d;

        // Retournez l'ancienneté sous forme de chaîne
        return "Ancienneté : $annees années, $mois mois, $jours jours";
    }

    // Méthode pour calculer la prime annuelle en prenant en compte la date d'embauche
    public function calculerPrimeAnnuelle() {
        // Calculez la prime basée sur le salaire annuel (5% du brut)
        $primeSalaire = $this->salaire * 0.05;

        // Obtenez l'ancienneté en années en utilisant la date d'embauche de l'employé
        $dateEmbauche = new DateTime($this->dateemb);
        $dateActuelle = new DateTime(); // Date actuelle

        $difference = $dateActuelle->diff($dateEmbauche);

        // Obtenez l'ancienneté en années, mois et jours
        $annees = $difference->y;

        // Calculez la prime basée sur l'ancienneté (2% du brut pour chaque année d'ancienneté)
        $primeAnciennete = ($this->salaire * 0.02) * $annees;

        // Calculez la prime totale
        $primeTotale = $primeSalaire + $primeAnciennete;

        return $primeTotale;
    }

    // Méthode pour générer l'ordre de transfert à la banque
    public function genererOrdreTransfert() {
        $prime = $this->calculerPrimeAnnuelle();
        $dateVersement = date('Y-m-d', strtotime('last day of November'));

        // Vous pouvez ici générer l'ordre de transfert à la banque,
        // par exemple, en créant une transaction ou en l'enregistrant dans un système.

        // Pour cet exemple, nous allons simplement l'afficher à l'écran.
        echo "Ordre de transfert à la banque pour une prime de $prime € le $dateVersement.";
    }
}

$employe = new Employe("Nom", "Prénom", 30, "2000-01-15", "Fonction", 50000, "Service");
$prime = $employe->calculerPrimeAnnuelle(); // Utilisez la date d'embauche définie dans le constructeur
echo "Prime annuelle : $prime €";
?>
