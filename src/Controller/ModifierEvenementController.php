<?php
session_start();
require_once '../../config/database.php';

$errors = [];
$regex_basic = "/^[^#%^&*\][;}{=+\\|><\`~]*$/";

// Fonction de nettoyage d'entrée
function safeInput($data)
{
    return htmlspecialchars(trim($data));
}

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Vérification de l'ID évènement
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php');
    exit;
}

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des données de l'évènement
$sql = "SELECT * FROM evenement WHERE id_eve = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirection si évènement non trouvé
if (!$evenement) {
    header('Location: ../../public/index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['titre']) || !preg_match($regex_basic, $_POST['titre'])) {
        $errors['titre'] = "Titre invalide";
    }

    if (empty($_POST['date'])) {
        $errors['date'] = "Date obligatoire";
    }

    if (empty($_POST['heure'])) {
        $errors['heure'] = "Heure obligatoire";
    }

    if (empty($_POST['lieu']) || !preg_match($regex_basic, $_POST['lieu'])) {
        $errors['lieu'] = "Lieu invalide";
    }

    if (empty($_POST['description']) || !preg_match($regex_basic, $_POST['description'])) {
        $errors['description'] = "Description invalide";
    }

    if (empty($errors)) {
        $sql = "UPDATE evenement 
                SET eve_titre = :titre, 
                    eve_date = :date, 
                    eve_heure = :heure, 
                    eve_lieu = :lieu, 
                    eve_description = :description
                WHERE id_eve = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':titre', safeInput($_POST['titre']), PDO::PARAM_STR);
        $stmt->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindValue(':heure', $_POST['heure'], PDO::PARAM_STR);
        $stmt->bindValue(':lieu', safeInput($_POST['lieu']), PDO::PARAM_STR);
        $stmt->bindValue(':description', safeInput($_POST['description']), PDO::PARAM_STR);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: PageEvenementController.php?id=' . $_GET['id']);
            exit;
        }
    }
}

include_once '../View/view_modifier_evenement.php';
