<?php

// Fonction pour afficher un message d'erreur
function afficher_erreur($message) {
    echo "<div class='erreur'>$message</div>";
}

// Fonction pour enregistrer une erreur dans la base de données
function enregistrer_erreur_bdd($message, $pdo) {
    $timestamp = date("Y-m-d H:i:s");
    try {
        // Préparer la requête SQL pour insérer l'erreur dans la base de données
        $sql = "INSERT INTO gestion_erreurs (description_erreur, heure_erreur, created_at) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        // Exécuter la requête en liant les valeurs des paramètres
        $stmt->execute([$message, $timestamp]);
    } catch(PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête, afficher un message
        afficher_erreur("Erreur lors de l'enregistrement de l'erreur : " . $e->getMessage());
    }
}

// Fonction pour enregistrer une action dans le journal d'activité
function enregistrer_activite($id_utilisateur, $action, $pdo) {
    $timestamp = date("Y-m-d H:i:s");
    try {
        // Préparer la requête SQL pour insérer l'activité dans le journal
        $sql = "INSERT INTO journal_activite (id_utilisateur, action, heure_action, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        // Exécuter la requête en liant les valeurs des paramètres
        $stmt->execute([$id_utilisateur, $action, $timestamp]);
    } catch(PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête, afficher un message
        afficher_erreur("Erreur lors de l'enregistrement de l'activité : " . $e->getMessage());
    }
}

// Fonction pour gérer les erreurs
function gerer_erreur($message) {
    // Afficher le message d'erreur
    afficher_erreur($message);
    // Vous pouvez ajouter ici d'autres actions à effectuer en cas d'erreur, comme l'enregistrement dans un fichier journal, etc.
}

?>
