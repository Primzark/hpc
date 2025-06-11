<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-evenement.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_eve = (int) $_GET['id'];

$evenement = Evenement::getById($id_eve);

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

Evenement::delete($id_eve);

header('Location: ../Controller/IndexController.php');
exit;
?>