<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/../Model/model-inscription.php';

$tournois = Evenement::getLatestByType(2, 3);
$actus = Evenement::getLatestByType(1, 3);
$userTournois = [];

$utiNom = '';
if (isset($_SESSION['user_id'])) {
    $user = Utilisateur::getById($_SESSION['user_id']);
    if ($user) {
        $utiNom = $user['uti_nom'];
    }
    $userTournois = Inscription::getUpcomingByUser($_SESSION['user_id']);
}

// Chargement de l'index
include_once(__DIR__ . '/../../public/index.php');
