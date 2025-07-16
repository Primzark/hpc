<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-inscription.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /connexion');
    exit;
}

$tournois = Inscription::getUpcomingEventsByUser($_SESSION['user_id']);

include_once __DIR__ . '/../View/view_vos_tournois.php';
