<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de connexion à la base de données
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $service = isset($_POST['service']) ? $_POST['service'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    // Vérifier les données non vides
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($service) && !empty($mot_de_passe)) {
        try {
            // Préparer la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, mail, service, mot_de_passe, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

            // Échapper les valeurs
            $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            // Exécuter la requête
            $stmt->execute([$nom, $prenom, $mail, $service, $mot_de_passe_hache]);

            // Récupérer toutes les informations de l'utilisateur nouvellement inscrit
            $sql = "SELECT * FROM utilisateurs WHERE mail = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

             // Appeler la fonction pour enregistrer l'activité d'inscription dans le journal
             enregistrer_activite($pdo->lastInsertId(), 'Inscription', $pdo);
             
            // Vérifier si l'utilisateur existe
            if ($user) {
                // Stocker toutes les informations de l'utilisateur dans la session
                session_start();
                $_SESSION['user'] = $user;

                // Rediriger l'utilisateur vers une page de succès avec toutes les informations dans l'URL
                header("Location: index.php?" . http_build_query($_POST));
                exit;
            } else {
                echo "Erreur lors de la récupération des informations de l'utilisateur nouvellement inscrit.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur, enregistrer une erreur dans la base de données et afficher un message
            $message = "Erreur lors de l'inscription : " . $e->getMessage();
            enregistrer_erreur_bdd($message, $pdo);
            echo $message;
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
} else {
    // Rediriger l'utilisateur vers la page d'inscription si le formulaire n'a pas été soumis
    header("Location: inscription.php");
    exit;
}
?>
