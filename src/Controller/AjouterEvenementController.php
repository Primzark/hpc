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

        // Insert event first (without image for now)
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO evenement (eve_titre, eve_date, eve_heure, eve_lieu, eve_description, id_type_eve) 
                                VALUES (:titre, :date, :heure, :lieu, :description, :type)");
        $stmt->bindValue(':titre', safeInput($_POST['titre']), PDO::PARAM_STR);
        $stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':heure', $_POST['heure'], PDO::PARAM_STR);
        $stmt->bindValue(':lieu', safeInput($_POST['lieu']), PDO::PARAM_STR);
        $stmt->bindValue(':description', safeInput($_POST['details']), PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->execute();
        $id_evenement = $pdo->lastInsertId();

        // Now handle image conversion after ID is generated
        $tmpPath = $_FILES['image']['tmp_name'];
        $uploadDir = '../../asset/img/';
        $newName = "event_" . $id_evenement . ".webp";
        $uploadPath = $uploadDir . $newName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $conversionSuccess = convertToWebP($tmpPath, $uploadPath);

        if ($conversionSuccess) {
            // Update event with image name
            $stmt = $pdo->prepare("UPDATE evenement SET eve_image = :image WHERE id_eve = :id");
            $stmt->bindValue(':image', $newName, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id_evenement, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: ../../public/index.php');
            exit;
        } else {
            $errors['image'] = "Format d'image non supporté (JPEG et PNG uniquement).";
        }
    }
}

include_once '../View/view_ajouter_evenement.php';
?>