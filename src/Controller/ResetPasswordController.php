<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

$token = $_GET['token'] ?? ($_POST['token'] ?? '');
if (!$token) {
    echo 'Lien invalide';
    exit;
}

$user = Utilisateur::getByResetToken($token);
if (!$user) {
    echo 'Lien expir\xC3\xA9 ou invalide';
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['password'])) {
        $errors['password'] = 'Champ obligatoire.';
    }
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Champ obligatoire.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
    }
    if (empty($errors)) {
        Utilisateur::updatePassword($user['id_uti'], $_POST['password']);
        $success = true;
    }
}

include_once __DIR__ . '/../View/view_reset_password.php';
