<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-trombinoscope.php';

$errors = [];

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
    header('Location: ../Controller/IndexController.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['image']['error'] === 4) {
        $errors['image'] = "Veuillez ajouter une image.";
    }

    if (empty($_POST['pseudo'])) {
        $errors['pseudo'] = "Veuillez entrer le pseudo.";
    }

    if (empty($errors)) {
        $tmpPath = $_FILES['image']['tmp_name'];
        $uploadDir = '../../asset/img/';
        $newName = 'trombi_' . time() . '.webp';
        $uploadPath = $uploadDir . $newName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $conversionSuccess = convertToWebP($tmpPath, $uploadPath);

        if ($conversionSuccess) {
            $result = Trombinoscope::ajouter(safeInput($_POST['pseudo']), $newName);
            if ($result) {
                header('Location: ../Controller/TrombinoscopeController.php');
                exit;
            } else {
                $errors['general'] = "Erreur lors de l'ajout.";
            }
        } else {
            $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
        }
    }
}

include_once '../View/view_ajouter_trombinoscope.php';
?>
