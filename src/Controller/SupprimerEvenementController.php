<?php
session_start();
require_once '../../config/database.php';

// Check user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/index.php');
    exit;
}

// Validate event ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../../public/index.php');
    exit;
}

$id_eve = (int) $_GET['id'];

// Create PDO connection once
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if event exists
$stmt = $pdo->prepare("SELECT * FROM evenement WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();

if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
    // Event not found, redirect to events list
    header('Location: ../../public/index.php?page=evenements');
    exit;
}

// Delete related inscriptions first due to foreign key constraints
$stmt = $pdo->prepare("DELETE FROM s_inscrit_a WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();

// Delete the event itself
$stmt = $pdo->prepare("DELETE FROM evenement WHERE id_eve = :id");
$stmt->bindValue(':id', $id_eve, PDO::PARAM_INT);
$stmt->execute();

// Redirect back to events page
header('Location: ../../public/index.php?page=evenements');
exit;
