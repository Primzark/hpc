<?php
define('DB_HOST', 'sql3.cluster1.easy-hebergement.net'); // exemple
define('DB_NAME', 'harfleurpokerc');  // le nom que tu as donné
define('DB_USER', 'harfleurpokerc');
define('DB_PASS', 'wC7t4O3s4c3ytIpPYkIA');

// Google reCAPTCHA v2 configuration
// Replace these placeholder keys with your own site and secret keys
define('RECAPTCHA_SITE_KEY', '6LfHSWsrAAAAAM2CWcvUV2W4psnR2B7Ct8cP9rhE');
define('RECAPTCHA_SECRET_KEY', '6LfHSWsrAAAAAFrZ9oXAepgD4FnTnfitEIBo-vzN');

// SMTP configuration for PHPMailer
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'starlod7696@gmail.com');
define('SMTP_PASS', 'besc oeum rrol rzsx');

// Base path for building absolute URLs
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $base === '/' ? '' : $base);
