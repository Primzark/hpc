<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-evenement.php';

$errors = [];
$regex_basic = "/^[^#%^&*\\][;}{=+\\|><`~]*$/";

function safeInput($data)
{
    return htmlspecialchars(trim($data));
}

function convertToWebP($sourcePath, $destinationPath, $quality = 80)
{
    $info = getimagesize($sourcePath);
    $mime = $info['mime'];

    if ($mime == 'image/jpeg') {
        $image = imagecreatefromjpeg($sourcePath);
    } elseif ($mime == 'image/png') {
        $image = imagecreatefrompng($sourcePath);
    } else {
        return false;
    }

    $result = imagewebp($image, $destinationPath, $quality);
    imagedestroy($image);
    return $result;
}

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php?page=connexion');
    exit;
}

// Vérifie l’ID de l’événement
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php');
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

    $imageToSave = $evenement['eve_image'];

    if (empty($errors)) {
        // Si une nouvelle image est uploadée
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['image']['tmp_name'];
            $uploadDir = '../../asset/img/';
            $newFileName = "event_" . $id_evenement . ".webp";
            $destinationPath = $uploadDir . $newFileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $conversionSuccess = convertToWebP($tmpPath, $destinationPath);
            if ($conversionSuccess) {
                // Supprimer l'ancienne image si elle est différente
                if (!empty($evenement['eve_image']) && $evenement['eve_image'] !== $newFileName) {
                    $oldPath = $uploadDir . $evenement['eve_image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $imageToSave = $newFileName;
            } else {
                $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
            }
        }
    }

    if (empty($errors)) {
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
