<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/../Model/model-inscription.php';
require_once __DIR__ . '/admin_required.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$event_id = (int) $_GET['id'];
$evenement = Evenement::getById($event_id);

if (!$evenement) {
    header('Location: /');
    exit;
}

$participants = Inscription::getParticipantsByEvent($event_id);

include_once __DIR__ . '/../View/view_participants_evenement.php';
