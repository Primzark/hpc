<?php

session_start();
// Démarre la session pour gérer la connexion utilisateur

include_once "../../config/database.php";
// Charge la configuration de la base de données

// Si l'utilisateur est déjà connecté, on détruit la session pour déconnecter
if (isset($_SESSION['user_id'])) {
    unset($_SESSION);
    session_destroy();
}

$errors = [];
// Tableau pour stocker les erreurs de connexion

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Si le formulaire est soumis en POST

    // Vérifie que le champ username (pseudo ou email) est rempli
    if (isset($_POST['username'])) {
        if (empty($_POST['username'])) {
            $errors['username'] = "Rentrez votre e-mail ou votre pseudo";
        }
    }

    // Vérifie que le champ mot de passe est rempli
    if (isset($_POST['password'])) {
        if (empty($_POST['password'])) {
            $errors['password'] = "Rentrez votre mot de passe";
        }
    }

    // Si username et password ne sont pas vides
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        // Connexion à la base de données
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recherche en base si le pseudo ou email existe
        $sql = "SELECT * FROM utilisateur WHERE uti_nom = :username OR uti_email = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();

        // Vérifie si un utilisateur a été trouvé
        $stmt->rowCount() == 0 ? $found = false : $found = true;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$found) {
            // Erreur si utilisateur non trouvé
            $errors['connexion'] = "Identifiant ou mot de passe incorrect";
        } else {
            // Vérifie que le mot de passe correspond avec le hash en base
            if (password_verify($_POST['password'], $user['uti_mdp'])) {
                // Stocke les infos utilisateur en session
                $_SESSION['user_id'] = $user['id_uti'];
                $_SESSION['user_admin'] = $user['uti_admin'];

                // Redirection vers la page d'accueil
                header('Location: ../../public/index.php?page=accueil');
                exit;
            } else {
                // Mot de passe incorrect
                $errors['connexion'] = "Identifiant ou mot de passe incorrect";
            }
        }
    }
}

// Affiche le formulaire de connexion (avec erreurs si besoin)
include_once "../View/view_connexion.php";
