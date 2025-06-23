<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once '../Model/model-classement.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

// Vérifie si l'ID du classement est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_cla = intval($_GET['id']);

Classement::delete($id_cla);

// Redirection vers classement après suppression
header('Location: ../Controller/ClassementController.php');
exit;
