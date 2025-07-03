<?php
session_start();
include_once __DIR__ . "/../../config.php";
include_once __DIR__ . '/../Model/model-evenement.php';
include_once __DIR__ . '/../Model/model-inscription.php';

$id = null;
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /");
    exit;
}

$id = (int) $_GET['id'];
$evenement = Evenement::getById($id);
$nombreInscrits = Inscription::countByEvent($id);
$estInscrit = false;

if (isset($_SESSION['user_id'])) {
    $estInscrit = Inscription::dejaInscrit($id, $_SESSION['user_id']);
}

include_once __DIR__ . '/../View/view_page_evenement.php';
