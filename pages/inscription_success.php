<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie - Projet Drone</title>
</head>
<body>
    <h1>Inscription réussie</h1>
    <?php
    session_start(); // Démarrer la session pour accéder aux informations de session

    // Vérifier si les informations sont disponibles dans la session
    if (isset($_SESSION['nom']) && isset($_SESSION['mail']) && isset($_SESSION['service'])) {
        // Récupérer le nom, l'e-mail et le service depuis la session
        $nom = $_SESSION['nom'];
        $mail = $_SESSION['mail'];
        $service = $_SESSION['service'];

        // Afficher un message de bienvenue avec le nom, l'e-mail et le service de l'utilisateur
        echo "<p>Bienvenue, $nom ! Votre inscription avec l'e-mail $mail et le service $service a été réussie.</p>";
    } else {
        // Afficher un message d'erreur si les informations ne sont pas disponibles dans la session
        echo "<p>Erreur : Impossible de récupérer les informations d'inscription ou de connexion.</p>";
    }
    ?>
</body>
</html>
