<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement.php';
require_once __DIR__ . '/../bad_words.php';
require_once __DIR__ . '/admin_required.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_cla = (int) $_GET['id'];
$classement = Classement::getById($id_cla);

if (!$classement) {
    header('Location: /');
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cla_nomjoueur'])) {
        $cla_nomjoueur = $_POST['cla_nomjoueur'];
    } else {
        $cla_nomjoueur = '';
    }
    if (isset($_POST['cla_rang'])) {
        $cla_rang = $_POST['cla_rang'];
    } else {
        $cla_rang = '';
    }
    if (isset($_POST['cla_points'])) {
        $cla_points = $_POST['cla_points'];
    } else {
        $cla_points = '';
    }

    if (!isset($_POST['cla_nomjoueur']) || trim($_POST['cla_nomjoueur']) == '') {
        $errors['nomjoueur'] = "Veuillez entrer le nom du joueur.";
    } elseif (!preg_match($regex, $_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Caractères non autorisés dans le nom du joueur.";
    } elseif (containsForbiddenWord($_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Nom interdit.";
    }

    if (!isset($_POST['cla_rang']) || trim($_POST['cla_rang']) == '') {
        $errors['rang'] = "Veuillez entrer le rang.";
    } elseif (!filter_var($_POST['cla_rang'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['rang'] = "Le rang doit être un entier positif.";
    }

    if (!isset($_POST['cla_points']) || trim($_POST['cla_points']) == '') {
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

        header('Location: /classement');
        exit;
    }
}

require_once __DIR__ . '/../View/view_modifier_classement.php';
