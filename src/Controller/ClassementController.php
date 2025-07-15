<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement-general.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

$general = ClassementGeneral::getAll();
$classement = [];
// Compute ranking based on points from classement_general
usort($general, function ($a, $b) {
    return $b['points'] <=> $a['points'];
});
$rank = 1;
foreach ($general as $entry) {
    $classement[] = [
        'cla_id_gen' => $entry['id_gen'],
        'cla_rang' => $rank++,
        'cla_nomjoueur' => $entry['uti_nom'],
        'cla_points' => $entry['points'],
    ];
}

include_once __DIR__ . '/../View/view_classement.php';
