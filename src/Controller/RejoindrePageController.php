<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/../Model/model-inscription.php'; // ← AJOUT

if (!isset($_GET['event']) || !is_numeric($_GET['event'])) {
    header('Location: /');
    exit;
}

$eventId = (int) $_GET['event'];
$evenement = Evenement::getById($eventId); // updated method name
$participantCount = Inscription::countByEvent($eventId);

if (!$evenement) {
    header('Location: /');
    exit;
}

$event_id = $eventId;

// Vérifie si l'utilisateur est déjà inscrit
$isRegistered = false;
if (isset($_SESSION['user_id'])) {
    $userId = (int) $_SESSION['user_id'];
    $isRegistered = Inscription::dejaInscrit($event_id, $userId);
}

include __DIR__ . '/../View/view_rejoindre_evenement.php';
