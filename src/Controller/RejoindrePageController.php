<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-evenement.php';
require_once '../Model/model-inscription.php'; // ← AJOUT

if (!isset($_GET['event']) || !is_numeric($_GET['event'])) {
    header('Location: ../../public/index.php');
    exit;
}

$eventId = (int) $_GET['event'];
$evenement = Evenement::getById($eventId); // updated method name

if (!$evenement) {
    header('Location: ../../public/index.php');
    exit;
}

$event_id = $eventId;

// Vérifie si l'utilisateur est déjà inscrit
$isRegistered = false;
if (isset($_SESSION['user_id'])) {
    $userId = (int) $_SESSION['user_id'];
    $isRegistered = Inscription::dejaInscrit($event_id, $userId);
}

include '../View/view_rejoindre_evenement.php';
