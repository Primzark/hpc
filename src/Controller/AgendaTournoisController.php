<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';

$fromDate = date('Y-m-d');
// On récupère un large panel de tournois pour couvrir l'année à venir.
$tournois = Evenement::getUpcomingByType(2, 300, $fromDate);

include_once __DIR__ . '/../View/view_agenda_tournois.php';
