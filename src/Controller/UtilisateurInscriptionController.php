<?php
session_start(); // Démarre la session

require_once '../../config/database.php'; // Charge la config base de données
require_once '../../src/Model/model-utilisateur.php'; // Charge le modèle Utilisateur

// Expressions régulières pour valider nom, email et mot de passe
$regex_nom = "/^[a-zA-Z0-9._%+-]{4,}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_password = "/^[a-zA-Z0-9.@-]{4,}$/";

$errors = []; // Tableau des erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation nom
    if (empty($_POST['nom'])) {
        $errors['nom'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_nom, $_POST['nom'])) {
        $errors['nom'] = 'Nom non valide.';
    } else {
        // Vérifie si nom déjà utilisé en base via modèle
        $userWithNom = Utilisateur::getByNom($_POST['nom']);
        if ($userWithNom !== false) {
            $errors['nom'] = 'Ce nom est déjà utilisé.';
        }
    }

    // Validation email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_email, $_POST['email'])) {
        $errors['email'] = 'Email non valide.';
    } else {
        // Vérifie si email déjà utilisé
        $userWithEmail = Utilisateur::getByEmail($_POST['email']);
        if ($userWithEmail !== false) {
            $errors['email'] = 'Cet email est déjà utilisé.';
        }
    }

    // Validation mot de passe
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

    // Si pas d’erreurs, appel modèle pour ajouter utilisateur
    if (empty($errors)) {
        Utilisateur::ajouter($_POST['nom'], $_POST['email'], $_POST['password']);

        // Récupère l'utilisateur fraîchement créé
        $user = Utilisateur::getByEmail($_POST['email']);

        // Démarre la session utilisateur
        $_SESSION['user_id'] = $user['id_uti'];
        $_SESSION['user_admin'] = $user['uti_admin'];

        // Redirige vers l'accueil connecté
        header('Location: ../../public/index.php?page=accueil');
        exit;
    }

}

include_once '../View/view_inscription.php'; // Affiche le formulaire
