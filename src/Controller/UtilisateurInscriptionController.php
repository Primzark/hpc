<?php
session_start(); // Démarre la session

require_once __DIR__ . '/../../config.php'; // Charge la config base de données
require_once __DIR__ . '/../Model/model-utilisateur.php'; // Charge le modèle Utilisateur
require_once __DIR__ . '/../bad_words.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // Charge PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Expressions régulières pour valider nom, email et mot de passe
$regex_nom = "/^[a-zA-Z0-9._%+-]{4,}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_password = "/^.{4,}$/"; // Allow any characters with minimum length 4

$nom = '';
$email = '';
$age = '';
$image_consent = false;

$errors = []; // Tableau des erreurs


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conserve les valeurs saisies
    if (isset($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $nom = '';
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = '';
    }
    if (isset($_POST['age'])) {
        $age = $_POST['age'];
    } else {
        $age = '';
    }
    if (isset($_POST['image_consent'])) {
        $image_consent = true;
    } else {
        $image_consent = false;
    }
    // Validation nom
    if (empty($_POST['nom'])) {
        $errors['nom'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_nom, $_POST['nom'])) {
        $errors['nom'] = 'Nom non valide.';
    } elseif (containsForbiddenWord($_POST['nom'])) {
        $errors['nom'] = 'Nom interdit.';
    } else {
        // Vérifie si nom déjà utilisé en base via modèle
        $userWithNom = Utilisateur::getByNom($_POST['nom']);
        if ($userWithNom !== false) {
            $errors['nom'] = "Impossible d'utiliser ce nom.";
        }
    }

    // Validation email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_email, $_POST['email'])) {
        $errors['email'] = 'Email non valide.';
    } else {
        // Vérifie si email déjà utilisé
        $userWithEmail = Utilisateur::getByEmail($_POST['email']);
        if ($userWithEmail !== false) {
            $errors['email'] = "Impossible d'utiliser cette adresse email.";
        }
    }

    // Validation âge
    if (empty($_POST['age'])) {
        $errors['age'] = 'Champ obligatoire.';
    } elseif (!is_numeric($_POST['age']) || (int) $_POST['age'] < 18) {
        $errors['age'] = 'Vous devez avoir au moins 18 ans pour vous inscrire.';
    } else {
        $age = (int) $_POST['age'];
    }

    // Validation mot de passe
    if (empty($_POST['password'])) {
        $errors['password'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_password, $_POST['password'])) {
        $errors['password'] = 'Le mot de passe doit contenir au moins 4 caractères.';
    }

    // Confirmation mot de passe
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Champ obligatoire.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
    }

    // Consentement à l'utilisation de l'image
    if (!$image_consent) {
        $errors['image_consent'] = 'Vous devez autoriser l\'utilisation de votre image.';
    }

    // Validation du reCAPTCHA v2
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
    } else {
        $recaptchaResponse = '';
    }
    if (empty($recaptchaResponse)) {
        $errors['captcha'] = "Veuillez confirmer que vous n'êtes pas un robot.";
    } else {
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $data = http_build_query([
            'secret' => RECAPTCHA_SECRET_KEY,
            'response' => $recaptchaResponse,
            'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''
        ]);

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $data,
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($verifyUrl, false, $context);
        if ($result) {
            $jsonInput = $result;
        } else {
            $jsonInput = '';
        }
        $resultData = json_decode($jsonInput, true);
        if (empty($resultData['success'])) {
            $errors['captcha'] = "La vérification reCAPTCHA a échoué.";
        }
    }

    // Si pas d’erreurs, appel modèle pour ajouter utilisateur
    if (empty($errors)) {
        $token = bin2hex(random_bytes(16));
        Utilisateur::ajouter($_POST['nom'], $_POST['email'], $_POST['age'], $_POST['password'], $token, $image_consent ? 1 : 0);

        $user = Utilisateur::getByEmail($_POST['email']);

        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else {
            $host = 'localhost';
        }
        $approveUrl = "https://{$host}/approve-registration?id={$user['id_uti']}&token={$token}";
        $rejectUrl = "https://{$host}/reject-registration?id={$user['id_uti']}&token={$token}";

        $message = "Nouvelle inscription:\n" .
            "Nom: {$user['uti_nom']}\n" .
            "Email: {$user['uti_email']}\n" .
            "Age: {$user['uti_age']}\n\n" .
            "Accepter: {$approveUrl}\n" .
            "Refuser: {$rejectUrl}";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->Port = SMTP_PORT;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(false);

            // Utiliser l'expéditeur authentifié pour éviter DMARC/SPF rejections
            $mail->setFrom(SMTP_USER, 'HPC - Inscriptions');
            // Facultatif: définir une adresse de réponse "noreply" sur le domaine du site
            $mail->addReplyTo('noreply@' . $host, 'Ne pas répondre');

            // Envoyer la notification à tous les administrateurs
            if (defined('ADMIN_EMAILS') && is_array(ADMIN_EMAILS)) {
                foreach (ADMIN_EMAILS as $adminEmail) {
                    if (!empty($adminEmail)) {
                        $mail->addAddress($adminEmail);
                    }
                }
            } else {
                // fallback (ancien comportement) si la constante n'est pas définie
                $mail->addAddress('patrick.piednoel@sfr.fr');
            }

            $mail->Subject = 'Nouvelle inscription';
            $mail->Body = $message;
            $mail->send();
        } catch (Exception $e) {
            // Journaliser l'erreur d'envoi pour diagnostic sans interrompre le flux utilisateur
            if (function_exists('error_log')) {
                error_log('[MAIL][Inscription] ' . $e->getMessage());
            }
        }

        header('Location: /inscription/confirm');

        exit;
    }
}

include_once __DIR__ . '/../View/view_inscription.php'; // Affiche le formulaire
