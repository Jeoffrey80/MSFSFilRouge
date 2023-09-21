<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Inclure le fichier de configuration pour établir la connexion PDO
include 'db_connection.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les quantités des plats
    $quantiteSushi = $_POST['quantiteSushi'];
    $quantiteMaki = $_POST['quantiteMaki'];
    $quantiteYakitori = $_POST['quantiteYakitori'];

    // Récupérer les informations de l'utilisateur depuis la session (vous devez ajuster ceci selon votre système de gestion d'utilisateurs)
    $idUtilisateur = $_SESSION['id']; // Supposons que vous stockez l'id de l'utilisateur dans la session
    $nomClient = $_SESSION['nom_client']; // Supposons que vous stockez le nom de l'utilisateur dans la session
    $telephoneClient = $_SESSION['telephone_client']; // Supposons que vous stockez le téléphone de l'utilisateur dans la session
    $emailClient = $_SESSION['email_client']; // Supposons que vous stockez l'email de l'utilisateur dans la session
    $adresseClient = $_SESSION['adresse_client']; // Supposons que vous stockez l'adresse de l'utilisateur dans la session

    // Calculer le total du prix de la commande
    // Vous devez remplacer ceci par le calcul réel basé sur les quantités et les prix de vos plats
    $totalPrix = ($quantiteSushi * 4.99) + ($quantiteMaki * 29.99) + ($quantiteYakitori * 14.99);

    try {
        // Préparer la requête SQL pour insérer les informations de commande dans la table commande
        $stmt = $pdo->prepare("
            INSERT INTO commande (id, id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client)
            VALUES (:id_utilisateur, :total_prix, NOW(), 'En cours', :nom_client, :telephone_client, :email_client, :adresse_client)
        ");

        // Exécuter la requête en liant les valeurs
        $stmt->execute([
            ':id_utilisateur' => $idUtilisateur,
            ':total_prix' => $totalPrix,
            ':nom_client' => $nomClient,
            ':telephone_client' => $telephoneClient,
            ':email_client' => $emailClient,
            ':adresse_client' => $adresseClient
        ]);

        // Récupérer l'id de la commande
        $idCommande = $pdo->lastInsertId();

        // Enregistrez maintenant les quantités pour chaque plat dans la table commande_plat
        $stmtPlat = $pdo->prepare("INSERT INTO commande (id, id_plat, quantite) VALUES (:id_commande, :id_plat, :quantite)");

        // Insérer la quantité pour chaque plat dans la table commande_plat
        $stmtPlat->execute([':id_commande' => $idCommande, ':id_plat' => 1, ':quantite' => $quantiteSushi]);
        $stmtPlat->execute([':id_commande' => $idCommande, ':id_plat' => 2, ':quantite' => $quantiteMaki]);
        $stmtPlat->execute([':id_commande' => $idCommande, ':id_plat' => 3, ':quantite' => $quantiteYakitori]);

        // Redirection vers une page de confirmation ou autre
        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, afficher le message d'erreur
        echo "Erreur : " . $e->getMessage();
    }
}
?>
