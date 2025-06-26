<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-inscription.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'unauthorized']);
    exit;
}

if (!isset($_POST['event']) || !is_numeric($_POST['event'])) {
    echo json_encode(['status' => 'error', 'message' => 'invalid_event']);
    exit;
}

$id_utilisateur = $_SESSION['user_id'];
$id_evenement = intval($_POST['event']);

if (Inscription::dejaInscrit($id_evenement, $id_utilisateur)) {
    Inscription::desinscrire($id_evenement, $id_utilisateur);
    $action = 'unregistered';
} else {
    Inscription::inscrire($id_evenement, $id_utilisateur);
    $action = 'registered';
}

$count = Inscription::countByEvent($id_evenement);
echo json_encode(['status' => 'success', 'action' => $action, 'count' => $count]);
