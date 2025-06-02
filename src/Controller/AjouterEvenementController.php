<?php
session_start();
require_once '../../config/database.php';
require_once '../../src/Model/model-evenement.php';

$errors = [];
$regex = "/^[^#%^&*\\][;}{=+\\|><`~]*$/";

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

function convertToWebP($sourcePath, $destinationPath, $quality = 80)
{
    $info = getimagesize($sourcePath);
    $mime = $info['mime'];

    if ($mime == 'image/jpeg') {
        $image = imagecreatefromjpeg($sourcePath);
        imagewebp($image, $destinationPath, $quality);
        imagedestroy($image);
        return true;
    }

    if ($mime == 'image/png') {
        $image = imagecreatefrompng($sourcePath);
        imagewebp($image, $destinationPath, $quality);
        imagedestroy($image);
        return true;
    }

    return false;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_FILES['image']['error'] === 4) {
        $errors['image'] = "Veuillez ajouter une image.";
    }

    if (empty($_POST['titre'])) {
        $errors['titre'] = "Veuillez sélectionner un titre.";
    }

    if (empty($_POST['lieu'])) {
        $errors['lieu'] = "Veuillez renseigner le lieu.";
    } elseif (!preg_match($regex, $_POST['lieu'])) {
        $errors['lieu'] = "Caractères non autorisés dans le lieu.";
    }

    if (empty($_POST['date'])) {
        $errors['date'] = "Veuillez entrer la date.";
    }

    if (empty($_POST['heure'])) {
        $errors['heure'] = "Veuillez entrer l'heure.";
    }

    if (empty($_POST['details'])) {
        $errors['details'] = "Veuillez entrer une description.";
    } elseif (!preg_match($regex, $_POST['details'])) {
        $errors['details'] = "Caractères non autorisés dans la description.";
    }

    if (empty($errors)) {
        $type = ($_POST['titre'] === 'Tournois') ? 2 : 1;

        $tmpPath = $_FILES['image']['tmp_name'];
        $newName = uniqid() . '.webp';
        $uploadDir = '../../asset/img/';
        $uploadPath = $uploadDir . $newName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $conversionSuccess = convertToWebP($tmpPath, $uploadPath);

        if ($conversionSuccess) {
            Evenement::ajouter(
                safeInput($_POST['titre']),
                safeInput($_POST['lieu']),
                $_POST['date'],
                $_POST['heure'],
                safeInput($_POST['details']),
                $newName,
                $type
            );

            header('Location: ../../public/index.php');
            exit;
        } else {
            $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
        }
    }
}

include_once '../View/view_ajouter_evenement.php';
?>