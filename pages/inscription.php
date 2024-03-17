<?php
// Empêcher le cache du navigateur
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé

// Continuer avec le reste du code PHP
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Projet Drone</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="inscription_traitement1.php" method="post">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="mail">Adresse e-mail :</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="service">Service :</label>
            <select id="service" name="service" required>
                <option value="informatique">Service informatique</option>
                <option value="commercial">Service commercial</option>
                <option value="administration">Service administration</option>
            </select>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
</body>
</html>
