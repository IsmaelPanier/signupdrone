<?php
$serveur = "localhost";
$utilisateur = "test"; // Remplacez par votre nom d'utilisateur MySQL
$mot_de_passe = "123456"; // Remplacez par votre mot de passe MySQL
$base_de_donnees = "drone";

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8mb4", $utilisateur, $mot_de_passe);
    // Configurer PDO pour qu'il génère des exceptions en cas d'erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur lors de la connexion, afficher un message et arrêter le script
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
