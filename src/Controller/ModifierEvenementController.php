<?php
session_start();
require_once '../../config/database.php';

// Protection d'accès
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Vérifie que l'identifiant est bien passé
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php');
    exit;
}

$id_evenement = intval($_GET['id']);

// Fonction de sécurisation
function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Connexion à la BDD
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On récupère l'évènement à modifier
$stmt = $pdo->prepare("SELECT * FROM evenement WHERE id_eve = :id");
$stmt->bindValue(':id', $id_evenement, PDO::PARAM_INT);
$stmt->execute();
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evenement) {
    header('Location: ../../public/index.php');
    exit;
}

$errors = [];
$lieu = $evenement['eve_lieu'];
$date = $evenement['eve_date'];
$heure = $evenement['eve_heure'];
$details = $evenement['eve_description'];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
            $destinationPath = '../../asset/img/' . $newFileName;

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
                unlink('../../asset/img/' . $evenement['eve_image']);
                $evenement['eve_image'] = $newFileName;
            } else {
                $errors['image'] = "Erreur lors de la conversion de l’image.";
            }
        }
    }

    // Si pas d'erreurs, on met à jour
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE evenement SET eve_lieu = :lieu, eve_date = :date, eve_heure = :heure, eve_description = :description, eve_image = :image WHERE id_eve = :id");

        $stmt->bindValue(':lieu', $lieu, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':heure', $heure, PDO::PARAM_STR);
        $stmt->bindValue(':description', $details, PDO::PARAM_STR);
        $stmt->bindValue(':image', $evenement['eve_image'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id_evenement, PDO::PARAM_INT);

        $stmt->execute();

        header("Location: /Poker_website/src/Controller/PageEvenementController.php?id=" . $id_evenement);
        exit;
    }
}

// On charge la vue avec les variables préparées
require_once '../View/view_modifier_evenement.php';
