<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/admin_required.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_eve = (int) $_GET['id'];

$evenement = Evenement::getById($id_eve);

// Si aucun événement correspondant trouvé, on redirige
if (!$evenement) {
    header('Location: /');
    exit;
}

// Suppression physique du fichier image
if (!empty($evenement['eve_image'])) {
    $imagePath = dirname(__DIR__, 2) . '/asset/img/' . $evenement['eve_image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

Evenement::delete($id_eve);

header('Location: /');
exit;
?>