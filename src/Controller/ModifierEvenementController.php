<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/admin_required.php';

// Vérifie que l'identifiant est bien passé
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_evenement = (int) $_GET['id'];

// Fonction de sécurisation
function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Récupération de l'évènement
$evenement = Evenement::getById($id_evenement);

if (!$evenement) {
    header('Location: /');
    exit;
}

$errors = [];
$lieu = $evenement['eve_lieu'];
$date = $evenement['eve_date'];
$heure = $evenement['eve_heure'];
$details = $evenement['eve_description'];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validation Lieu
    if (empty($_POST['lieu'])) {
        $errors['lieu'] = "Le lieu est obligatoire.";
    } else {
        $lieu = safeInput($_POST['lieu']);
    }

    // Validation Date
    if (empty($_POST['date'])) {
        $errors['date'] = "La date est obligatoire.";
    } else {
        $date = safeInput($_POST['date']);
    }

    // Validation Heure
    if (empty($_POST['heure'])) {
        $errors['heure'] = "L'heure est obligatoire.";
    } else {
        $heure = safeInput($_POST['heure']);
    }

    // Validation Détails
    if (empty($_POST['description'])) {
        $errors['details'] = "La description est obligatoire.";
    } else {
        $details = safeInput($_POST['description']);
    }

    // Gestion de l'image si nouveau fichier envoyé
    if ($_FILES['image']['error'] !== 4) {

        $fileName = $_FILES['image']['name'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = mime_content_type($fileTmpPath);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($fileType, $allowedTypes)) {
            $errors['image'] = "Seuls les fichiers JPG, JPEG, PNG et WEBP sont autorisés.";
        } else {
            // Générer un nom unique en WebP
            $newFileName = uniqid('event_', true) . '.webp';
            $destinationPath = dirname(__DIR__, 2) . '/asset/img/' . $newFileName;

            // Conversion en WebP
            $image = null;
            if ($fileType == 'image/jpeg') {
                $image = imagecreatefromjpeg($fileTmpPath);
            } elseif ($fileType == 'image/png') {
                $image = imagecreatefrompng($fileTmpPath);
            }

            if ($image && imagewebp($image, $destinationPath, 80)) {
                imagedestroy($image);
                // Suppression de l'ancienne image si nouveau fichier
                unlink(dirname(__DIR__, 2) . '/asset/img/' . $evenement['eve_image']);
                $evenement['eve_image'] = $newFileName;
            } else {
                $errors['image'] = "Erreur lors de la conversion de l’image.";
            }
        }
    }

    // Si pas d'erreurs, on met à jour
    if (empty($errors)) {
        Evenement::updateEvenement($id_evenement, [
            'lieu' => $lieu,
            'date' => $date,
            'heure' => $heure,
            'description' => $details,
            'image' => $evenement['eve_image']
        ]);

        header("Location: /page-evenement?id=" . $id_evenement);
        exit;
    }
}

// On charge la vue avec les variables préparées
require_once __DIR__ . '/../View/view_modifier_evenement.php';
