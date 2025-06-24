<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-trombinoscope.php';

$errors = [];
$pseudo = '';

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

function convertToWebP($sourcePath, $destinationPath, $quality = 75)
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

if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['pseudo'] ?? '';
    if ($_FILES['image']['error'] == 4) {
        $errors['image'] = "Veuillez ajouter une image.";
    }

    if (empty($_POST['pseudo'])) {
        $errors['pseudo'] = "Veuillez entrer le pseudo.";
    }

    if (empty($errors)) {
        $uploadDir = dirname(__DIR__, 2) . '/asset/img/';
        $tmpPath = $_FILES['image']['tmp_name'];

        // Insert pseudo first to retrieve its ID
        $id = Trombinoscope::ajouter(safeInput($_POST['pseudo']));
        $newName = 'trombi_' . $id . '.webp';
        $uploadPath = $uploadDir . $newName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $conversionSuccess = convertToWebP($tmpPath, $uploadPath);

        if ($conversionSuccess) {
            $result = Trombinoscope::updateImage($id, $newName);
            if ($result) {
                header('Location: /trombinoscope');
                exit;
            } else {
                $errors['general'] = "Erreur lors de l'ajout.";
            }
        } else {
            $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
        }
    }
}

include_once __DIR__ . '/../View/view_ajouter_trombinoscope.php';
?>