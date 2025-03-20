<?php
// Chemin vers la base de données SQLite
$db_path = __DIR__ . '/../database/cook.sqlite';

// Fonction de connexion
function connect() {
    global $db_path;
    return new SQLite3($db_path);
}

// Fonction d'initialisation de la base de données
function initiate() {
    $db = connect();

    // Création de la table users si elle n'existe pas
    $query_users = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL
    )";
    $db->exec($query_users);

    // Création de la table recettes (optionnel)
    $query_recettes = "CREATE TABLE IF NOT EXISTS recettes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titre TEXT NOT NULL,
        description TEXT NOT NULL,
        auteur_id INTEGER NOT NULL,
        FOREIGN KEY(auteur_id) REFERENCES users(id)
    )";
    $db->exec($query_recettes);
}

// Exécute l'initialisation au chargement du fichier
initiate();
?>
