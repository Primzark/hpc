<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-inscription.php';

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
    echo json_encode(['status' => 'success', 'action' => 'unregistered']);
} else {
    Inscription::inscrire($id_evenement, $id_utilisateur);
    echo json_encode(['status' => 'success', 'action' => 'registered']);
}
