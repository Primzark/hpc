<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/admin_required.php';

$errors = [];
$regex = "/^[^#%^&*\\][;}{=+\\|><`~]*$/";

$titre = '';
$lieu = '';
$date = '';
$heure = '';
$details = '';

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

// Pré-remplit la date si passée en paramètre GET (depuis l'agenda)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (isset($_GET['date'])) {
        $d = $_GET['date'];
        $dt = DateTime::createFromFormat('Y-m-d', $d);
        if ($dt && $dt->format('Y-m-d') === $d) {
            $date = $d;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['titre'])) {
        $titre = $_POST['titre'];
    } else {
        $titre = '';
    }
    if (isset($_POST['lieu'])) {
        $lieu = $_POST['lieu'];
    } else {
        $lieu = '';
    }
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $date = '';
    }
    if (isset($_POST['heure'])) {
        $heure = $_POST['heure'];
    } else {
        $heure = '';
    }
    if (isset($_POST['details'])) {
        $details = $_POST['details'];
    } else {
        $details = '';
    }

    if ($_FILES['image']['error'] == 4) {
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
        if ($_POST['titre'] == 'Tournois') {
            $type = 2;
        } else {
            $type = 1;
        }

        $tmpPath = $_FILES['image']['tmp_name'];
        $uploadDir = dirname(__DIR__, 2) . '/asset/img/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newName = uniqid('event_', true) . '.webp';
        $uploadPath = $uploadDir . $newName;
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

            header('Location: /');
            exit;
        } else {
            $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
        }
    }
}

include_once __DIR__ . '/../View/view_ajouter_evenement.php';
?>
