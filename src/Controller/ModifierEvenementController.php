<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-evenement.php';

$errors = [];
$regex_basic = "/^[^#%^&*\][;}{=+\\|><\`~]*$/";

function safeInput($data)
{
    return htmlspecialchars(trim($data));
}

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php?page=connexion');
    exit;
}

// Vérifie l’ID de l’événement
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /Poker_website/public/index.php');
    exit;
}

$id_evenement = intval($_GET['id']);
$evenement = Evenement::getById($id_evenement);

// Redirection si événement inexistant
if (!$evenement) {
    header('Location: ../../public/index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = safeInput($_POST['date']);
    $heure = safeInput($_POST['heure']);
    $lieu = safeInput($_POST['lieu']);
    $description = safeInput($_POST['description']);

    // Validation
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
        // 1) Gestion du champ image : si upload, on le déplace, sinon on garde l’ancien
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $newName = uniqid() . "_" . basename($_FILES['image']['name']);
                $uploadDir = '../../asset/img/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imageToSave = $newName;
                } else {
                    $errors['image'] = "Impossible de déplacer le fichier uploadé.";
                    $imageToSave = $evenement['eve_image'];
                }
            } else {
                $errors['image'] = "Erreur lors de l'upload de l'image.";
                $imageToSave = $evenement['eve_image'];
            }
        } else {
            // Aucun fichier uploadé → on conserve l’ancien nom de l’image
            $imageToSave = $evenement['eve_image'];
        }

        // 2) Appel de la mise à jour en base AVEC la clé 'image'
        $success = Evenement::updateEvenement($id_evenement, [
            'date' => $date,
            'heure' => $heure,
            'lieu' => $lieu,
            'description' => $description,
            'image' => $imageToSave
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
