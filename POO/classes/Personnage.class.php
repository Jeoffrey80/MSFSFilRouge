<?php
class Personnage {
    private $nom;
    private $prenom;
    private $age;
    private $sexe;

    // Accesseurs pour obtenir la valeur des attributs
    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSexe() {
        return $this->sexe;
    }

    // Accesseurs pour définir la valeur des attributs
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    // Méthode pour afficher le personnage
    public function __toString() {
        return "Nom : {$this->nom}, Prénom : {$this->prenom}, Age : {$this->age}, Sexe : {$this->sexe}";
    }
}
?>
