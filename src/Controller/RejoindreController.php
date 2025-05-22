<?php
session_start();
// Démarre la session pour gérer l’utilisateur connecté

require_once '../../config/database.php';
// Crée la connexion PDO à la base de données
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifie que l’utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['user_id'])) {
  header('Location: ConnexionController.php');
  exit();
}

// Vérifie que l’ID de l’évènement est présent dans l’URL et est un nombre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: ../../public/index.php');
  exit();
}

$id_utilisateur = $_SESSION['user_id'];
$id_evenement = intval($_GET['id']);

// Vérifie si l’utilisateur est déjà inscrit à cet évènement
$sql = "SELECT * FROM s_inscrit_a WHERE id_uti = :id_utilisateur AND id_eve = :id_evenement";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$stmt->bindValue(':id_evenement', $id_evenement, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  // Si déjà inscrit, affiche un message d’avertissement
  header("Location: ../View/message.php?type=warning&msg=Vous êtes déjà inscrit à cet évènement.");
  exit();
}

// Sinon, insère l’inscription en base
$sql = "INSERT INTO s_inscrit_a (id_uti, id_eve) VALUES (:id_utilisateur, :id_evenement)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$stmt->bindValue(':id_evenement', $id_evenement, PDO::PARAM_INT);
$stmt->execute();

include_once '../View/view_rejoindre_evenement.php'; // Affiche le formulaire
