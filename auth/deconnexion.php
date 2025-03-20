<?php
session_start();
session_destroy(); // Supprime toutes les données de session
header("Location: ../index.php"); // Redirige vers la page d'accueil
exit();
?>
