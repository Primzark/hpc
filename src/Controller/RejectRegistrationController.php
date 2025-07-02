<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $token = '';
}
if (!$id || !is_numeric($id)) {
    echo 'Paramètres invalides';
    exit;
}

$user = Utilisateur::getById((int) $id);
if (!$user || $user['uti_approval_token'] !== $token) {
    echo 'Lien invalide';
    exit;
}

Utilisateur::delete($user['id_uti']);

echo 'Inscription refusée';

