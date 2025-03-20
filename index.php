<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
</head>
<body>

<h1>Bienvenue sur alex il cook</h1>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="auth/deconnexion.php" class="btn">Déconnexion</a>
<?php else: ?>
    <a href="auth/connexion.php" class="btn">Connexion</a>
<?php endif; ?>

</body>
</html>
