<?php
session_start(); // Démarre la session

require_once __DIR__ . '/../../config.php'; // Charge la config base de données
require_once __DIR__ . '/../Model/model-utilisateur.php'; // Charge le modèle Utilisateur
require_once __DIR__ . '/../../vendor/autoload.php'; // Charge PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Expressions régulières pour valider nom, email et mot de passe
$regex_nom = "/^[a-zA-Z0-9._%+-]{4,}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_password = "/^[a-zA-Z0-9.@-]{4,}$/";

$nom = '';
$email = '';
$age = '';

$errors = []; // Tableau des erreurs


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conserve les valeurs saisies
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    // Validation nom
    if (empty($_POST['nom'])) {
        $errors['nom'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_nom, $_POST['nom'])) {
        $errors['nom'] = 'Nom non valide.';
    } else {
        // Vérifie si nom déjà utilisé en base via modèle
        $userWithNom = Utilisateur::getByNom($_POST['nom']);
        if ($userWithNom !== false) {
            $errors['nom'] = 'Ce nom est déjà utilisé.';
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
            $errors['email'] = 'Cet email est déjà utilisé.';
        }
    }

    // Validation âge
    if (empty($_POST['age'])) {
        $errors['age'] = 'Champ obligatoire.';
    } elseif (!is_numeric($_POST['age']) || intval($_POST['age']) < 18) {
        $errors['age'] = 'Vous devez avoir au moins 18 ans pour vous inscrire.';
    } else {
        $age = intval($_POST['age']);
    }

    // Validation mot de passe
    if (empty($_POST['password'])) {
        $errors['password'] = 'Champ obligatoire.';
    } elseif (!preg_match($regex_password, $_POST['password'])) {
        $errors['password'] = 'Mot de passe invalide.';
    }

    // Confirmation mot de passe
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Champ obligatoire.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
    }

    // Validation du reCAPTCHA v2
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    if (empty($recaptchaResponse)) {
        $errors['captcha'] = "Veuillez confirmer que vous n'êtes pas un robot.";
    } else {
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $data = http_build_query([
            'secret' => RECAPTCHA_SECRET_KEY,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
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
        $resultData = json_decode($result ?: '', true);
        if (empty($resultData['success'])) {
            $errors['captcha'] = "La vérification reCAPTCHA a échoué.";
        }
    }

    // Si pas d’erreurs, appel modèle pour ajouter utilisateur
    if (empty($errors)) {
        $token = bin2hex(random_bytes(16));
        Utilisateur::ajouter($_POST['nom'], $_POST['email'], $_POST['password'], $token);

        $user = Utilisateur::getByEmail($_POST['email']);

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $approveUrl = "http://{$host}/approve-registration?id={$user['id_uti']}&token={$token}";
        $rejectUrl = "http://{$host}/reject-registration?id={$user['id_uti']}&token={$token}";

        $message = "Nouvelle inscription:\n" .
            "Nom: {$user['uti_nom']}\n" .
            "Email: {$user['uti_email']}\n\n" .
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
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom('noreply@' . $host, 'Inscription');
            $mail->addAddress('starlod7696@gmail.com');
            $mail->Subject = 'Nouvelle inscription';
            $mail->Body = $message;
            $mail->send();
        } catch (Exception $e) {
            // Unable to send email; silently fail
        }

        header('Location: /inscription/confirm');
        exit;
    }
}

include_once __DIR__ . '/../View/view_inscription.php'; // Affiche le formulaire
