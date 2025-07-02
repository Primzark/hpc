<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errors = [];
$email = '';
$sent = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        $errors['email'] = "Veuillez entrer votre email.";
    } else {
        $email = trim($_POST['email']);
        $user = Utilisateur::getByEmail($email);
        if ($user) {
            $token = bin2hex(random_bytes(16));
            $expires = date('Y-m-d H:i:s', time() + 3600);
            Utilisateur::setResetToken($email, $token, $expires);

            if (isset($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            } else {
                $host = 'localhost';
            }
            $resetUrl = "http://{$host}/reset-password?token={$token}";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->Port       = SMTP_PORT;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USER;
                $mail->Password   = SMTP_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                $mail->setFrom('noreply@' . $host, 'HPC');
                $mail->addAddress($email);
                $mail->Subject = 'R\xC3\xA9initialisation de votre mot de passe';
                $mail->Body    = "Pour r\xC3\xA9initialiser votre mot de passe, cliquez sur ce lien : {$resetUrl}";
                $mail->send();
            } catch (Exception $e) {
                // échec ignoré
            }
        }
        $sent = true;
        $email = '';
    }
}

include_once __DIR__ . '/../View/view_forgot_password.php';
