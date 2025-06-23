<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-utilisateur.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_uti = intval($_GET['id']);

Utilisateur::delete($id_uti);

header('Location: ../Controller/UtilisateursController.php');
exit;
?>
