<?php
session_start();
require_once('../includes/database.php');

// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = connect();
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (isset($_POST['inscription'])) {  // Inscription
        // Vérifie si l'email existe déjà
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray();

        if ($result) {
            echo "<script>alert('Cet email est déjà utilisé.'); window.location.href = '../auth/connexion.php';</script>";
            exit();
        }

        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insère l'utilisateur
        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);
        $stmt->execute();

        echo "<script>alert('Inscription réussie. Connectez-vous !'); window.location.href = '../auth/connexion.php';</script>";
        exit();

    } elseif (isset($_POST['connexion'])) {  // Connexion
        // Vérifie si l'utilisateur existe
        $stmt = $db->prepare("SELECT id, password FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            echo "<script>alert('Connexion réussie !'); window.location.href = '../index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Identifiants incorrects.'); window.location.href = '../auth/connexion.php';</script>";
            exit();
        }
    }
}
?>
