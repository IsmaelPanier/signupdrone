<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion avec un message de déconnexion
header("Location: connexion.php?logout=true");
exit;
?>
