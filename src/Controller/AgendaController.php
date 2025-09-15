<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';

// Détermine le mois et l'année courants ou depuis les paramètres
$month = isset($_GET['month']) && is_numeric($_GET['month']) ? (int) $_GET['month'] : (int) date('n');
$year = isset($_GET['year']) && is_numeric($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');

if ($month < 1 || $month > 12) {
    $month = (int) date('n');
}
if ($year < 1970 || $year > 2100) {
    $year = (int) date('Y');
}

// Premier et dernier jour du mois
$firstDay = sprintf('%04d-%02d-01', $year, $month);
$lastDay = date('Y-m-t', strtotime($firstDay));

// Evènements du mois
$events = Evenement::getByDateRange($firstDay, $lastDay);

// Regroupe par jour (Y-m-d)
$eventsByDate = [];
foreach ($events as $e) {
    $d = $e['eve_date'];
    if (!isset($eventsByDate[$d])) {
        $eventsByDate[$d] = [];
    }
    $eventsByDate[$d][] = $e;
}

// Liens de navigation mois précédent/suivant
$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

// Affiche la vue
include_once __DIR__ . '/../View/view_agenda.php';
