<?php
session_start();
require_once '../../config/database.php';

// Connection
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve classement with only existing columns
$sql = "SELECT cla_rang, cla_nomjoueur, cla_points FROM classement ORDER BY cla_rang ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$classement = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once '../View/view_classement.php';
