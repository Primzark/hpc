<?php
session_start();
require_once '../../config/database.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /Poker_website/public/index.php');
    exit;
}

// Vérifie si l'ID du classement est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('../Controller/ClassementController.php');
    exit;
}

$id_cla = intval($_GET['id']);

// Connexion BDD
$pdo = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
    DB_USER,
    DB_PASS
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Suppression du classement
$stmtDelete = $pdo->prepare("DELETE FROM classement WHERE id_cla = :id");
$stmtDelete->bindValue(':id', $id_cla, PDO::PARAM_INT);
$stmtDelete->execute();

// Redirection vers classement après suppression
header('Location: ../Controller/ClassementController.php');
exit;
