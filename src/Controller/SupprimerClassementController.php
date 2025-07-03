<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement.php';
require_once __DIR__ . '/admin_required.php';


// Vérifie si l'ID du classement est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id_cla = (int) $_GET['id'];

Classement::delete($id_cla);

// Redirection vers classement après suppression
header('Location: /classement');
exit;
