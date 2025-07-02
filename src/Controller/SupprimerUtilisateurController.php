<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/admin_required.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_uti = intval($_GET['id']);

Utilisateur::delete($id_uti);

header('Location: ' . BASE_PATH . '/utilisateurs');
exit;
?>