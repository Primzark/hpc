<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

$id = $_GET['id'] ?? null;
$token = $_GET['token'] ?? '';
if (!$id || !is_numeric($id)) {
    echo 'Paramètres invalides';
    exit;
}

$user = Utilisateur::getById((int)$id);
if (!$user || $user['uti_approval_token'] !== $token) {
    echo 'Lien invalide';
    exit;
}

Utilisateur::setApproved($user['id_uti'], 1);

echo 'Inscription approuvée';

