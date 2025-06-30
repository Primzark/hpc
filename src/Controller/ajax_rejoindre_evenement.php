<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-inscription.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'erreur', 'message' => 'Non autorisé']);
    exit;
}

if (!isset($_POST['event']) || !is_numeric($_POST['event'])) {
    echo json_encode(['status' => 'erreur', 'message' => 'Événement invalide']);
    exit;
}

$id_utilisateur = $_SESSION['user_id'];
$id_evenement = intval($_POST['event']);

if (Inscription::dejaInscrit($id_evenement, $id_utilisateur)) {
    Inscription::desinscrire($id_evenement, $id_utilisateur);
    $action = 'desinscrit';
} else {
    Inscription::inscrire($id_evenement, $id_utilisateur);
    $action = 'inscrit';
}

$count = Inscription::countByEvent($id_evenement);
echo json_encode(['status' => 'success', 'action' => $action, 'count' => $count]);
