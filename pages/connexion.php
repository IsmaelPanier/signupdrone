<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de configuration de la base de données
require_once('../includes/db.php');
// Inclure le fichier des fonctions
require_once('../includes/functions.php');

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    // Vérifier si les champs ne sont pas vides
    if (!empty($mail) && !empty($mot_de_passe)) {
        try {
            // Préparer et exécuter la requête pour récupérer l'utilisateur avec cet e-mail
            $sql = "SELECT * FROM utilisateurs WHERE mail = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe
            if ($user) {
                // Vérifier le mot de passe
                if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
                    // Connexion réussie, stocker toutes les informations de l'utilisateur dans la session
                    $_SESSION['user'] = $user;

                    // Enregistrer l'activité de connexion dans le journal
                    enregistrer_activite($user['id'], 'Connexion', $pdo);

                    // Rediriger vers la page d'accueil
                    header("Location: index.php");
                    exit;
                } else {
                    // Mot de passe incorrect
                    gerer_erreur("Mot de passe incorrect.");
                }
            } else {
                // Utilisateur introuvable
                gerer_erreur("Adresse e-mail incorrecte ou utilisateur introuvable.");
            }
        } catch(PDOException $e) {
            // Erreur PDO
            gerer_erreur("Erreur lors de la connexion : " . $e->getMessage());
        }
    } else {
        // Champs vides
        gerer_erreur("Tous les champs doivent être remplis.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Projet Drone</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (isset($message_erreur)) : ?>
        <p><?php echo $message_erreur; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="mail">Adresse e-mail :</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
</body>
</html>
