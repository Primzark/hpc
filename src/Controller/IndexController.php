<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-evenement.php';
require_once '../Model/model-utilisateur.php';

$tournois = Evenement::getLatestByType(2, 3);
$actus = Evenement::getLatestByType(1, 3);

$utiNom = '';
if (isset($_SESSION['user_id'])) {
    $user = Utilisateur::getById($_SESSION['user_id']);
    if ($user) {
        $utiNom = $user['uti_nom'];
    }
}

// Chargement de l'index
include_once('../../public/index.php');
