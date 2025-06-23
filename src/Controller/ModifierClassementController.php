<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-classement.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_cla = intval($_GET['id']);
$classement = Classement::getById($id_cla);

if (!$classement) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$errors = [];
$cla_nomjoueur = $classement['cla_nomjoueur'];
$cla_rang = $classement['cla_rang'];
$cla_points = $classement['cla_points'];

$regex = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-'\.]+$/u";

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cla_nomjoueur = $_POST['cla_nomjoueur'] ?? '';
    $cla_rang = $_POST['cla_rang'] ?? '';
    $cla_points = $_POST['cla_points'] ?? '';

    if (!isset($_POST['cla_nomjoueur']) || trim($_POST['cla_nomjoueur']) === '') {
        $errors['nomjoueur'] = "Veuillez entrer le nom du joueur.";
    } elseif (!preg_match($regex, $_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Caractères non autorisés dans le nom du joueur.";
    }

    if (!isset($_POST['cla_rang']) || trim($_POST['cla_rang']) === '') {
        $errors['rang'] = "Veuillez entrer le rang.";
    } elseif (!filter_var($_POST['cla_rang'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['rang'] = "Le rang doit être un entier positif.";
    }

    if (!isset($_POST['cla_points']) || trim($_POST['cla_points']) === '') {
        $errors['points'] = "Veuillez entrer le nombre de points.";
    } elseif (!filter_var($_POST['cla_points'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
        $errors['points'] = "Les points doivent être un entier positif ou nul.";
    }

    if (empty($errors)) {
        Classement::updateClassement($id_cla, [
            'nomjoueur' => safeInput($_POST['cla_nomjoueur']),
            'rang' => (int) $_POST['cla_rang'],
            'points' => (int) $_POST['cla_points']
        ]);

        header('Location: ../Controller/ClassementController.php');
        exit;
    }
}

require_once '../View/view_modifier_classement.php';
