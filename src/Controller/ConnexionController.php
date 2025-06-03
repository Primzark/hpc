<?php
session_start();
require_once '../../config/database.php';

$errors = [];
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Vérification des champs vides
    if (empty($email)) {
        $errors['email'] = "Veuillez entrer votre email.";
    }

    if (empty($password)) {
        $errors['password'] = "Veuillez entrer votre mot de passe.";
    }

    // Si pas d'erreurs, on tente la connexion
    if (empty($errors)) {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT id_uti, uti_mdp FROM utilisateur WHERE uti_email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['uti_mdp'])) {
            $_SESSION['user_id'] = $user['id_uti'];
            header('Location: ../../public/index.php');
            exit;
        } else {
            $errors['general'] = "Identifiants incorrects.";
        }
    }
}

include_once('../View/view_connexion.php');
