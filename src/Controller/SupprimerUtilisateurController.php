<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_uti = intval($_GET['id']);

Utilisateur::delete($id_uti);

header('Location: ' . BASE_PATH . '/utilisateurs');
exit;
?>
