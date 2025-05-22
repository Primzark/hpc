<?php
session_start(); // Démarre la session

require_once '../../config/database.php'; // Charge la config base de données

// Expressions régulières pour valider pseudo, email et mot de passe
$regex_pseudo = "/^[a-zA-Z0-9._%+-]{4,}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_password = "/^[a-zA-Z0-9.@-]{4,}$/";

$errors = []; // Tableau des erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie et valide les champs du formulaire

    // Pseudo
    if (empty($_POST['pseudo'])) {
        $errors['pseudo'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_pseudo, $_POST['pseudo'])) {
        $errors['pseudo'] = 'Pseudo non valide.';
    } else {
        // Vérifie si pseudo déjà utilisé en base
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $checkPseudo = $pdo->prepare("SELECT * FROM utilisateur WHERE uti_nom = :pseudo");
        $checkPseudo->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $checkPseudo->execute();

        if ($checkPseudo->rowCount() > 0) {
            $errors['pseudo'] = 'Ce pseudo est déjà utilisé.';
        }
    }

    // Email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_email, $_POST['email'])) {
        $errors['email'] = 'Email non valide.';
    }

    // Mot de passe
    if (empty($_POST['password'])) {
        $errors['password'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_password, $_POST['password'])) {
        $errors['password'] = 'Mot de passe invalide.';
    }

    // Confirmation mot de passe
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Champ obligatoire.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
    }

    // Si pas d’erreurs, insertion en base
    if (empty($errors)) {
        $sql = "INSERT INTO utilisateur (uti_nom, uti_email, uti_mdp, uti_admin) VALUES (:nom, :email, :mdp, :admin)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nom', $_POST['pseudo'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(':mdp', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':admin', 0, PDO::PARAM_BOOL);
        $stmt->execute();

        header('Location: index.php'); // Redirection après succès
        exit;
    }
}

include_once '../View/view_inscription.php'; // Affiche le formulaire
