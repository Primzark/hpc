<?php
session_start();
require_once '../../config/database.php';

$errors = [];
$regex = "/^[^#%^&*\][;}{=+\\|><`~]*$/";

function safeInput($string)
{
    return htmlspecialchars(trim($string));
}

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate image
    if ($_FILES['image']['error'] === 4) {
        $errors['image'] = "Veuillez ajouter une image.";
    }

    // Validate titre (must be a predefined value from select)
    if (empty($_POST['titre'])) {
        $errors['titre'] = "Veuillez sélectionner un titre.";
    }

    // Validate lieu
    if (empty($_POST['lieu'])) {
        $errors['lieu'] = "Veuillez renseigner le lieu.";
    } elseif (!preg_match($regex, $_POST['lieu'])) {
        $errors['lieu'] = "Caractères non autorisés dans le lieu.";
    }

    // Validate date
    if (empty($_POST['date'])) {
        $errors['date'] = "Veuillez entrer la date.";
    }

    // Validate heure
    if (empty($_POST['heure'])) {
        $errors['heure'] = "Veuillez entrer l'heure.";
    }

    // Validate description
    if (empty($_POST['details'])) {
        $errors['details'] = "Veuillez entrer une description.";
    } elseif (!preg_match($regex, $_POST['details'])) {
        $errors['details'] = "Caractères non autorisés dans la description.";
    }

    if (empty($errors)) {
        $newName = uniqid() . "_" . basename($_FILES['image']['name']);
        $uploadDir = '../../asset/img/';
        $uploadPath = $uploadDir . $newName;

        // DB connection
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO evenement (eve_titre, eve_date, eve_heure, eve_lieu, eve_description, id_type_eve, eve_image)
                VALUES (:titre, :date, :heure, :lieu, :description, :type, :image)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':titre', safeInput($_POST['titre']), PDO::PARAM_STR);
        $stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':heure', $_POST['heure'], PDO::PARAM_STR);
        $stmt->bindValue(':lieu', safeInput($_POST['lieu']), PDO::PARAM_STR);
        $stmt->bindValue(':description', safeInput($_POST['details']), PDO::PARAM_STR);
        $type = ($_POST['titre'] === 'Tournois') ? 2 : 1;
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->bindValue(':image', $newName, PDO::PARAM_STR);

        if ($stmt->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            header('Location: ../../public/index.php?page=accueil');
            exit;
        }
    }
}

include_once '../View/view_ajouter_evenement.php';
