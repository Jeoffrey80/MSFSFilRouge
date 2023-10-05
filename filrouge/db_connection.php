<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=lavallee', 'lavallee', 'Admin1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
?>