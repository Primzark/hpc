<?php
session_start();
require_once '../../config.php';

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT id_uti, uti_mdp FROM utilisateur WHERE uti_email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['uti_mdp'])) {
            $_SESSION['user_id'] = $user['id_uti'];
            header("Location: ../../index.php");
            exit;
        } else {
            $errors['email'] = "Email ou mot de passe incorrect.";
            $errors['password'] = "Email ou mot de passe incorrect.";
        }
    }
}

// On appelle la vue en lui passant les variables
require_once '../../src/View/view_connexion.php';
?>