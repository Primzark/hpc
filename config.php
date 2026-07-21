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

// Configuration SMTP dédiée à l'envoi des agendas. En production, les
// identifiants sont chargés depuis config.local.php, qui n'est jamais versionné.
$agendaSmtpConfig = [];
$agendaSmtpConfigPath = __DIR__ . '/config.local.php';
if (is_readable($agendaSmtpConfigPath)) {
    $loadedAgendaSmtpConfig = require $agendaSmtpConfigPath;
    if (is_array($loadedAgendaSmtpConfig)) {
        $agendaSmtpConfig = $loadedAgendaSmtpConfig;
    }
}

define('AGENDA_SMTP_HOST', $agendaSmtpConfig['AGENDA_SMTP_HOST'] ?? SMTP_HOST);
define('AGENDA_SMTP_PORT', (int) ($agendaSmtpConfig['AGENDA_SMTP_PORT'] ?? SMTP_PORT));
define('AGENDA_SMTP_USER', $agendaSmtpConfig['AGENDA_SMTP_USER'] ?? SMTP_USER);
define('AGENDA_SMTP_PASS', $agendaSmtpConfig['AGENDA_SMTP_PASS'] ?? SMTP_PASS);

unset($agendaSmtpConfig, $agendaSmtpConfigPath, $loadedAgendaSmtpConfig);

// Liste des emails administrateurs recevant les validations d'inscriptions
// Kader et Patrick
define('ADMIN_EMAILS', [
    'sourisopc@free.fr',
    'patrick.piednoel@sfr.fr',
]);

// Chemin de base pour créer les URLs absolues
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $base == '/' ? '' : $base);
