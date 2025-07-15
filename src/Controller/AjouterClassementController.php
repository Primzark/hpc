<?php
// Démarre la session pour gérer les variables de session (authentification)
session_start();

// Inclusion du fichier de connexion à la base de données
require_once __DIR__ . '/../../config.php';
// Inclusion du modèle qui contient les fonctions liées au classement
require_once __DIR__ . '/../Model/model-classement.php';
require_once __DIR__ . '/../Model/model-classement-general.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/../bad_words.php';
require_once __DIR__ . '/admin_required.php';

// Initialisation du tableau des erreurs
$errors = [];
$cla_nomjoueur = '';

// Expression régulière pour valider le nom du joueur (lettres, espaces, tirets, apostrophes, points autorisés)
$regex = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-'\.]+$/u";

// Fonction de nettoyage des données pour éviter les failles XSS
function safeInput($string)
{
    return htmlspecialchars(trim($string));
}



// Si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cla_nomjoueur'])) {
        $cla_nomjoueur = $_POST['cla_nomjoueur'];
    } else {
        $cla_nomjoueur = '';
    }

    // Vérification du champ nom du joueur
    if (!isset($_POST['cla_nomjoueur']) || trim($_POST['cla_nomjoueur']) == '') {
        $errors['nomjoueur'] = "Veuillez entrer le nom du joueur.";
    } elseif (!preg_match($regex, $_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Caractères non autorisés dans le nom du joueur.";
    } elseif (containsForbiddenWord($_POST['cla_nomjoueur'])) {
        $errors['nomjoueur'] = "Nom interdit.";
    }



    // Si aucune erreur n'est détectée, on traite l'ajout
    if (empty($errors)) {
        // On récupère l'identifiant de l'utilisateur connecté (par défaut 1 pour les tests)
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = 1;
        }

        // On appelle la méthode du modèle pour insérer les données avec des valeurs par défaut
        $result = Classement::ajouter(
            safeInput($_POST['cla_nomjoueur']),
            0,
            0,
            $user_id
        );

        // Ajout dans le classement général si non présent
        $user = Utilisateur::getByNom(safeInput($_POST['cla_nomjoueur']));
        if ($user) {
            $cg = ClassementGeneral::getByUserId($user['id_uti']);
            if (!$cg) {
                ClassementGeneral::insert($user['id_uti']);
            }
        }

        // Si l'ajout réussit, on redirige vers la page de classement
        if ($result) {
            header('Location: /classement');
            exit;
        } else {
            // En cas d'échec de l'insertion
            $errors['general'] = "Erreur lors de l'ajout du classement.";
        }
    }
}

// Si le formulaire n'a pas été soumis ou s'il y a des erreurs, on affiche le formulaire avec les erreurs
include_once __DIR__ . '/../View/view_ajouter_classement.php';
?>