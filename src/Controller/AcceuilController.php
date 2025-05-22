<?php
session_start();
require_once '../../config/database.php';
// Connexion à la base de données
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les 3 prochains tournois
$sqlTournois = "SELECT * FROM evenement 
                WHERE id_type_eve = 2 AND eve_date >= CURDATE() 
                ORDER BY eve_date ASC 
                LIMIT 3";
$stmtTournois = $pdo->prepare($sqlTournois);
$stmtTournois->execute();
$tournois = $stmtTournois->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les 3 dernières actualités
$sqlActus = "SELECT * FROM evenement 
             WHERE id_type_eve = 1 
             ORDER BY eve_date DESC 
             LIMIT 3";
$stmtActus = $pdo->prepare($sqlActus);
$stmtActus->execute();
$actus = $stmtActus->fetchAll(PDO::FETCH_ASSOC);

// Chargement de la vue
include_once '../View/view_acceuil.php';

