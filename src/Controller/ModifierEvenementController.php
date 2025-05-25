<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-evenement.php';

$errors = [];
$regex_basic = "/^[^#%^&*\][;}{=+\\|><\`~]*$/";

function safeInput($data) {
    return htmlspecialchars(trim($data));
}

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php?page=connexion');
    exit;
}

// Vérifie l’ID de l’événement
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php?page=accueil');
    exit;
}

$id_evenement = intval($_GET['id']);
$evenement = Evenement::getById($id_evenement);

// Redirection si événement inexistant
if (!$evenement) {
    header('Location: ../../public/index.php?page=accueil');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = safeInput($_POST['titre']);
    $date = safeInput($_POST['date']);
    $heure = safeInput($_POST['heure']);
    $lieu = safeInput($_POST['lieu']);
    $description = safeInput($_POST['description']);

    // Validation
    if (empty($titre) || !preg_match($regex_basic, $titre)) {
        $errors['titre'] = "Titre invalide";
    }
    if (empty($date)) {
        $errors['date'] = "Date obligatoire";
    }
    if (empty($heure)) {
        $errors['heure'] = "Heure obligatoire";
    }
    if (empty($lieu) || !preg_match($regex_basic, $lieu)) {
        $errors['lieu'] = "Lieu invalide";
    }
    if (empty($description) || !preg_match($regex_basic, $description)) {
        $errors['description'] = "Description invalide";
    }

    if (empty($errors)) {
        $success = Evenement::updateEvenement($id_evenement, [
            'titre' => $titre,
            'date' => $date,
            'heure' => $heure,
            'lieu' => $lieu,
            'description' => $description
        ]);

        if ($success) {
            header("Location: PageEvenementController.php?id=" . $id_evenement);
            exit;
        } else {
            $errors['global'] = "Erreur lors de la mise à jour de l'évènement.";
        }
    }
}

include_once '../View/view_modifier_evenement.php';
