<?php
define('DB_HOST', 'sql3.cluster1.easy-hebergement.net'); // exemple
define('DB_NAME', 'harfleurpokerc');  // le nom que tu as donné
define('DB_USER', 'harfleurpokerc');
define('DB_PASS', 'wC7t4O3s4c3ytIpPYkIA');

// Configuration de Google reCAPTCHA v2
// Remplacez ces clés d'exemple par vos propres clés site et secrète
define('RECAPTCHA_SITE_KEY', '6LfHSWsrAAAAAM2CWcvUV2W4psnR2B7Ct8cP9rhE');
define('RECAPTCHA_SECRET_KEY', '6LfHSWsrAAAAAFrZ9oXAepgD4FnTnfitEIBo-vzN');

// Configuration SMTP pour PHPMailer
define('SMTP_HOST', 'smtp.sfr.fr');
define('SMTP_PORT', 465);
define('SMTP_USER', 'patrick.piednoel@sfr.fr');
define('SMTP_PASS', 'Partylite76700!');

// Liste des emails administrateurs recevant les validations d'inscriptions
// Kader et Patrick
define('ADMIN_EMAILS', [
    'sourisopc@free.fr',
    'patrick.piednoel@sfr.fr',
]);

// Chemin de base pour créer les URLs absolues
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $base == '/' ? '' : $base);
