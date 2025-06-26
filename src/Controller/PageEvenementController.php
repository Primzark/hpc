<?php
session_start();
include_once __DIR__ . "/../../config.php";
include_once __DIR__ . '/../Model/model-evenement.php';
include_once __DIR__ . '/../Model/model-inscription.php';

if (!isset($_GET['id'])) {
    header("Location: /");
    exit;
}

$evenement = Evenement::getById(id_eve: $_GET['id']);
$nombreInscrits = Inscription::countByEvent($_GET['id']);
$estInscrit = false;

if (isset($_SESSION['user_id'])) {
    $estInscrit = Inscription::dejaInscrit($_GET['id'], $_SESSION['user_id']);
}

include_once __DIR__ . '/../View/view_page_evenement.php';
