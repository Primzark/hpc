<?php
// Démarre la session pour gérer les variables de session (authentification)
session_start();

// Inclusion du fichier de connexion à la base de données
require_once __DIR__ . '/../../config.php';
// Inclusion du modèle qui contient les fonctions liées au classement
require_once __DIR__ . '/../Model/model-classement.php';

// Initialisation du tableau des erreurs
$errors = [];
$cla_nomjoueur = '';
$cla_rang = '';
$cla_points = '';

// Expression régulière pour valider le nom du joueur (lettres, espaces, tirets, apostrophes, points autorisés)
$regex = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-'\.]+$/u";

// Fonction de nettoyage des données pour éviter les failles XSS
function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

// Si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cla_nomjoueur = $_POST['cla_nomjoueur'] ?? '';
    $cla_rang = $_POST['cla_rang'] ?? '';
    $cla_points = $_POST['cla_points'] ?? '';

    // Vérification du champ nom du joueur
    if (!isset($_POST['cla_nomjoueur']) || trim($_POST['cla_nomjoueur']) == '') {
        $errors['nomjoueur'] = "Veuillez entrer le nom du joueur.";
    } elseif (!preg_match($regex, $_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Caractères non autorisés dans le nom du joueur.";
    }

    // Vérification du champ rang
    if (!isset($_POST['cla_rang']) || trim($_POST['cla_rang']) == '') {
        $errors['rang'] = "Veuillez entrer le rang.";
    } elseif (!filter_var($_POST['cla_rang'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['rang'] = "Le rang doit être un entier positif.";
    }

    // Vérification du champ points
    if (!isset($_POST['cla_points']) || trim($_POST['cla_points']) == '') {
        $errors['points'] = "Veuillez entrer le nombre de points.";
    } elseif (!filter_var($_POST['cla_points'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
        $errors['points'] = "Les points doivent être un entier positif ou nul.";
    }

    // Si aucune erreur n'est détectée, on traite l'ajout
    if (empty($errors)) {
        // On récupère l'identifiant de l'utilisateur connecté (par défaut 1 pour les tests)
        $user_id = $_SESSION['user_id'] ?? 1;

        // On appelle la méthode du modèle pour insérer les données
        $result = Classement::ajouter(
            safeInput($_POST['cla_nomjoueur']),
            (int) $_POST['cla_rang'],
            (int) $_POST['cla_points'],
            $user_id
        );

        // Si l'ajout réussit, on redirige vers la page de classement
        if ($result) {
            header('Location: ../Controller/ClassementController.php');
            exit;
        } else {
            // En cas d'échec de l'insertion
            $errors['general'] = "Erreur lors de l'ajout du classement.";
        }
    }
}

// Si le formulaire n'a pas été soumis ou s'il y a des erreurs, on affiche le formulaire avec les erreurs
include_once __DIR__ . '/../View/view_ajouter_classement.php';
?>