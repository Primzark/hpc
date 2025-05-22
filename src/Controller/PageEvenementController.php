<?php
session_start();
require_once '../../config/database.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/');
    exit;
}

// Vérifie que l'ID de l'évènement est bien fourni et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupère les infos de l'évènement
$sql = "SELECT * FROM evenement WHERE id_eve = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirection si l'évènement n'existe pas
if (!$evenement) {
    header('Location: ../../public/index.php');
    exit;
}

include_once '../View/view_page_evenement.php';
