<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

// Initialisation
$errors = [];
$email = '';
$password = '';

// Fonction de sécurisation
function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Vérifie la méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validation Email
    if (empty($_POST['email'])) {
        $errors['email'] = "Veuillez entrer votre email.";
    } else {
        $email = safeInput($_POST['email']);
    }

    // Validation Password
    if (empty($_POST['password'])) {
        $errors['password'] = "Veuillez entrer votre mot de passe.";
    } else {
        $password = $_POST['password'];
    }

    // Si pas d'erreurs de validation de base
    if (empty($errors)) {

        $user = Utilisateur::getByEmail($email);

        if ($user && password_verify($password, $user['uti_mdp'])) {
            if (!$user['uti_approved']) {
                $errors['email'] = "Votre inscription n'a pas encore été approuvée.";
                $errors['password'] = "Votre inscription n'a pas encore été approuvée.";
            } else {
            $_SESSION['user_id'] = $user['id_uti'];
            $_SESSION['user_admin'] = $user['uti_admin'];
            header("Location: /");
            exit;
            }
        } else {
            $errors['email'] = "Email ou mot de passe incorrect.";
            $errors['password'] = "Email ou mot de passe incorrect.";
        }
    }
}

// On appelle la vue en lui passant les variables
require_once __DIR__ . '/../View/view_connexion.php';
?>