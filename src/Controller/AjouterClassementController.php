<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-classement.php';

$errors = [];
$regex = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-'\.]+$/u";

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate player name
    if (!isset($_POST['cla_nomjoueur']) || trim($_POST['cla_nomjoueur']) === '') {
        $errors['nomjoueur'] = "Veuillez entrer le nom du joueur.";
    } elseif (!preg_match($regex, $_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Caractères non autorisés dans le nom du joueur.";
    }

    // Validate rank
    if (!isset($_POST['cla_rang']) || trim($_POST['cla_rang']) === '') {
        $errors['rang'] = "Veuillez entrer le rang.";
    } elseif (!filter_var($_POST['cla_rang'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['rang'] = "Le rang doit être un entier positif.";
    }

    // Validate points
    if (!isset($_POST['cla_points']) || trim($_POST['cla_points']) === '') {
        $errors['points'] = "Veuillez entrer le nombre de points.";
    } elseif (!filter_var($_POST['cla_points'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
        $errors['points'] = "Les points doivent être un entier positif ou nul.";
    }

    if (empty($errors)) {
        $user_id = $_SESSION['user_id'] ?? 1; // fallback user_id = 1 for testing

        $result = Classement::ajouter(
            safeInput($_POST['cla_nomjoueur']),
            (int) $_POST['cla_rang'],
            (int) $_POST['cla_points'],
            $user_id
        );

        if ($result) {
            header('Location: ../../public/index.php?page=classement');
            exit;
        } else {
            $errors['general'] = "Erreur lors de l'ajout du classement.";
        }
    }
}

// Show form (with errors if any)
include_once '../View/view_ajouter_classement.php';
