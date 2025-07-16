<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement-general.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/admin_required.php';

// Ensure every registered user has an entry in classement_general
$users = Utilisateur::getAll();
foreach ($users as $u) {
    $existing = ClassementGeneral::getByUserId($u['id_uti']);
    if (!$existing) {
        ClassementGeneral::insert($u['id_uti']);
    }
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['entries'] as $id_gen => $data) {
        $points = isset($data['points']) ? (int)$data['points'] : 0;
        $bounty = isset($data['bounty']) ? (int)$data['bounty'] : 0;
        ClassementGeneral::update($id_gen, $points, $bounty);
    }
}

if ($search !== '') {
    $classementGeneral = ClassementGeneral::searchByName($search);
} else {
    $classementGeneral = ClassementGeneral::getAll();
}
include_once __DIR__ . '/../View/view_classement_general.php';
