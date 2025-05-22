<?php
session_start();
require_once '../../config/database.php';

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération simple du classement
$sql = "SELECT cla_rang, cla_nomjoueur, cla_points FROM classement ORDER BY cla_rang ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$classement = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once '../View/view_classement.php';
