<?php
session_start();
require_once '../../config/database.php';
require_once '../../src/Model/model-evenement.php'; // include your Evenement model

$errors = [];
$regex = "/^[^#%^&*\][;}{=+\\|><`~]*$/";

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /Poker_website/public/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate image
    if ($_FILES['image']['error'] === 4) {
        $errors['image'] = "Veuillez ajouter une image.";
    }

    // Validate titre (must be a predefined value from select)
    if (empty($_POST['titre'])) {
        $errors['titre'] = "Veuillez sélectionner un titre.";
    }

    // Validate lieu
    if (empty($_POST['lieu'])) {
        $errors['lieu'] = "Veuillez renseigner le lieu.";
    } elseif (!preg_match($regex, $_POST['lieu'])) {
        $errors['lieu'] = "Caractères non autorisés dans le lieu.";
    }

    // Validate date
    if (empty($_POST['date'])) {
        $errors['date'] = "Veuillez entrer la date.";
    }

    // Validate heure
    if (empty($_POST['heure'])) {
        $errors['heure'] = "Veuillez entrer l'heure.";
    }

    // Validate description
    if (empty($_POST['details'])) {
        $errors['details'] = "Veuillez entrer une description.";
    } elseif (!preg_match($regex, $_POST['details'])) {
        $errors['details'] = "Caractères non autorisés dans la description.";
    }

    if (empty($errors)) {
        $newName = uniqid() . "_" . basename($_FILES['image']['name']);
        $uploadDir = '../../asset/img/';
        $uploadPath = $uploadDir . $newName;

        // Determine type id based on titre
        $type = ($_POST['titre'] === 'Tournois') ? 2 : 1;

        // Call the Evenement model method ajouter()
        Evenement::ajouter(
            safeInput($_POST['titre']),
            safeInput($_POST['lieu']),
            $_POST['date'],
            $_POST['heure'],
            safeInput($_POST['details']),
            $newName,
            $type
        );

        // Move uploaded file after successful DB insertion
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

        header('Location: /Poker_website/public/index.php');
        exit;
    }
}

include_once '../View/view_ajouter_evenement.php';
