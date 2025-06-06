<?php
session_start();
require_once '../../config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_eve = (int) $_GET['id'];

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On récupère l'événement pour connaitre le fichier image à supprimer
$stmt = $pdo->prepare("SELECT eve_image FROM evenement WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

// Si aucun événement correspondant trouvé, on redirige
if (!$evenement) {
    header('../Controller/IndexController.php');
    exit;
}

// Suppression physique du fichier image
if (!empty($evenement['eve_image'])) {
    $imagePath = '../../asset/img/' . $evenement['eve_image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// Suppression des inscriptions liées (clés étrangères)
$stmt = $pdo->prepare("DELETE FROM s_inscrit_a WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();

// Suppression de l'événement en base
$stmt = $pdo->prepare("DELETE FROM evenement WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();

header('Location: ../Controller/IndexController.php');
exit;
?>