<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement-general.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

$general = ClassementGeneral::getAllOrderedByTotalPoints();
$classement = [];
$rank = 1;

foreach ($general as $entry) {
    $totalPoints = isset($entry['total_points'])
        ? (int)$entry['total_points']
        : ((int)$entry['points'] + (int)$entry['bounty']);

    $classement[] = [
        'cla_id_gen' => $entry['id_gen'],
        'cla_rang' => $rank++,
        'cla_nomjoueur' => $entry['uti_nom'],
        'cla_points' => $totalPoints,
    ];
}

include_once __DIR__ . '/../View/view_classement.php';
