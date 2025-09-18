<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';
require_once __DIR__ . '/../Model/model-evenement.php';
require_once __DIR__ . '/admin_required.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agenda');
    exit;
}

// Récupère les membres approuvés
$emails = Utilisateur::getAllApprovedEmails();

// Récupère le périmètre à envoyer
$start = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$selectedIds = isset($_POST['selected_ids']) && is_array($_POST['selected_ids']) ? $_POST['selected_ids'] : [];
$useSelectionOnly = isset($_POST['use_selection']) && $_POST['use_selection'] === '1';

// Validation simple des dates (YYYY-MM-DD)
$isValidDate = function ($d) {
    if (!$d) return false;
    $dt = DateTime::createFromFormat('Y-m-d', $d);
    return $dt && $dt->format('Y-m-d') === $d;
};

if ($isValidDate($start) && $isValidDate($end)) {
    $startDate = DateTime::createFromFormat('Y-m-d', $start);
    $endDate = DateTime::createFromFormat('Y-m-d', $end);
    if ($startDate && $endDate && $startDate > $endDate) {
        [$startDate, $endDate] = [$endDate, $startDate];
    }
    $start = $startDate ? $startDate->format('Y-m-d') : $start;
    $end = $endDate ? $endDate->format('Y-m-d') : $end;

    $events = Evenement::getByDateRange($start, $end);

    if ($useSelectionOnly && !empty($selectedIds)) {
        $selectedIds = array_map('intval', $selectedIds);
        $selectedIds = array_filter($selectedIds, function ($id) {
            return $id > 0;
        });
        if (!empty($selectedIds)) {
            $events = array_values(array_filter(
                $events,
                function ($event) use ($selectedIds) {
                    return in_array((int) $event['id_eve'], $selectedIds, true);
                }
            ));
        }
    }
} elseif ($useSelectionOnly && !empty($selectedIds)) {
    $events = Evenement::getByIds($selectedIds);
} else {
    // défaut: 12 prochains mois
    $from = date('Y-m-d');
    $to = date('Y-m-d', strtotime('+12 months'));
    $events = Evenement::getByDateRange($from, $to);
}

function ics_escape_text($text)
{
    return str_replace(["\\", ";", ",", "\n", "\r"], ["\\\\", "\\;", "\\,", "\\n", ''], $text);
}

$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'harfleurpokerclub76.fr';
$prodId = '-//Harfleur Poker Club//Agenda//FR';

$ics = "BEGIN:VCALENDAR\r\n" .
    "VERSION:2.0\r\n" .
    "PRODID:$prodId\r\n" .
    "CALSCALE:GREGORIAN\r\n" .
    "METHOD:PUBLISH\r\n" .
    "X-WR-CALNAME:Harfleur Poker Club\r\n";

$tz = new DateTimeZone('Europe/Paris');
foreach ($events as $e) {
    $title = ics_escape_text($e['eve_titre']);
    $desc = ics_escape_text($e['eve_description']);
    $loc = ics_escape_text($e['eve_lieu']);

    $startLocal = DateTime::createFromFormat('Y-m-d H:i:s', $e['eve_date'] . ' ' . $e['eve_heure'], $tz);
    if (!$startLocal) {
        $startLocal = DateTime::createFromFormat('Y-m-d H:i:s', $e['eve_date'] . ' 09:00:00', $tz);
    }
    $startUtc = clone $startLocal;
    $startUtc->setTimezone(new DateTimeZone('UTC'));
    $dtStart = $startUtc->format('Ymd\THis\Z');
    $endUtc = clone $startUtc;
    $endUtc->modify('+2 hours');
    $dtEnd = $endUtc->format('Ymd\THis\Z');

    $uid = 'eve-' . $e['id_eve'] . '@' . $host;
    $url = 'https://' . $host . '/page-evenement?id=' . $e['id_eve'];

    $ics .= "BEGIN:VEVENT\r\n" .
        "UID:$uid\r\n" .
        "SUMMARY:$title\r\n" .
        "DTSTART:$dtStart\r\n" .
        "DTEND:$dtEnd\r\n" .
        "LOCATION:$loc\r\n" .
        "DESCRIPTION:$desc\\nPlus d'informations: $url\r\n" .
        "URL:$url\r\n" .
        "END:VEVENT\r\n";
}

$ics .= "END:VCALENDAR\r\n";

// Corps du message (texte simple)
$lines = [];
$lines[] = 'Bonjour,';
$lines[] = '';
$lines[] = "Voici l'agenda des évènements du Harfleur Poker Club.";
$lines[] = 'Vous pouvez importer le fichier agenda joint (ICS) dans votre calendrier.';
$lines[] = 'Ou vous abonner au flux: https://' . $host . '/agenda.ics';
$lines[] = '';
$lines[] = 'Evènements inclus:';
foreach ($events as $e) {
    $dateStr = date('d/m/Y', strtotime($e['eve_date'])) . ' ' . date('H:i', strtotime($e['eve_heure'])) . ' - ';
    $lines[] = '• ' . $dateStr . $e['eve_titre'] . ' (' . $e['eve_lieu'] . ')';
}
$lines[] = '';
$lines[] = 'A bientôt';
$message = implode("\n", $lines);

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

    $mail->setFrom(SMTP_USER, 'HPC - Agenda');
    // adresse To technique, pour éviter d'exposer les destinataires
    $mail->addAddress(SMTP_USER);
    foreach ($emails as $addr) {
        $mail->addBCC($addr);
    }

    $mail->Subject = 'Agenda du Harfleur Poker Club';
    $mail->Body = $message;
    $mail->addStringAttachment($ics, 'agenda-hpc.ics', 'base64', 'text/calendar; method=PUBLISH; charset=UTF-8');

    $mail->send();
    header('Location: /agenda?sent=1');
    exit;
} catch (Exception $e) {
    if (function_exists('error_log')) {
        error_log('[MAIL][Agenda] ' . $e->getMessage());
    }
    header('Location: /agenda?sent=0');
    exit;
}
