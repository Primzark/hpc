<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once '../Model/model-evenement.php';

// Redirection si l'utilisateur n'est pas connecté
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../../public/index.php');
//     exit;
// }


$evenements = Evenement::getAll();

include_once '../View/view_evenements.php';
