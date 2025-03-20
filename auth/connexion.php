<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Connexion / Inscription</title>
</head>
<body>
    <section>
        <h1>Connexion / Inscription</h1>
        <form action="parametres.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe</label>
            <input type="password" name="password" required>
            
            <button type="submit" name="connexion">Se connecter</button>
            <button type="submit" name="inscription">S'inscrire</button>
        </form>
    </section>
</body>
</html>
