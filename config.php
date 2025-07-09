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
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'starlod7696@gmail.com');
define('SMTP_PASS', 'besc oeum rrol rzsx');

// Clés API sandbox pour Stripe
define('STRIPE_SECRET_KEY', 'sk_test_yourkey');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_yourkey');

// Identifiants PayPal sandbox
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_CLIENT_SECRET', 'your_paypal_client_secret');

// Chemin de base pour créer les URLs absolues
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $base == '/' ? '' : $base);
