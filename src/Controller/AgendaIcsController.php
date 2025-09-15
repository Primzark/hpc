<?php
// Génère un flux ICS (iCalendar) de tous les évènements à venir
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="agenda-hpc.ics"');

function ics_escape($text)
{
    $text = str_replace(["\\", ";", ",", "\n", "\r"], ["\\\\", "\\;", "\\,", "\\n", ''], $text);
    return $text;
}

$from = date('Y-m-d');
$to = date('Y-m-d', strtotime('+12 months'));
$events = Evenement::getByDateRange($from, $to);

$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'harfleurpokerclub76.fr';
$prodId = '-//Harfleur Poker Club//Agenda//FR';

echo "BEGIN:VCALENDAR\r\n";
echo "VERSION:2.0\r\n";
echo "PRODID:" . $prodId . "\r\n";
echo "CALSCALE:GREGORIAN\r\n";
echo "METHOD:PUBLISH\r\n";
echo "X-WR-CALNAME:Harfleur Poker Club\r\n";

$tz = new DateTimeZone('Europe/Paris');
foreach ($events as $e) {
    $title = ics_escape($e['eve_titre']);
    $desc = ics_escape($e['eve_description']);
    $loc = ics_escape($e['eve_lieu']);

    // Combine date + time in Europe/Paris then convert to UTC Zulu
    $startLocal = DateTime::createFromFormat('Y-m-d H:i:s', $e['eve_date'] . ' ' . $e['eve_heure'], $tz);
    if (!$startLocal) {
        // fallback: only date
        $startLocal = DateTime::createFromFormat('Y-m-d H:i:s', $e['eve_date'] . ' 09:00:00', $tz);
    }
    $startUtc = clone $startLocal;
    $startUtc->setTimezone(new DateTimeZone('UTC'));
    $dtStart = $startUtc->format('Ymd\THis\Z');

    // Optionnel: fixe une durée par défaut de 2h
    $endUtc = clone $startUtc;
    $endUtc->modify('+2 hours');
    $dtEnd = $endUtc->format('Ymd\THis\Z');

    $uid = 'eve-' . $e['id_eve'] . '@' . $host;
    $url = 'https://' . $host . '/page-evenement?id=' . $e['id_eve'];

    echo "BEGIN:VEVENT\r\n";
    echo "UID:$uid\r\n";
    echo "SUMMARY:$title\r\n";
    echo "DTSTART:$dtStart\r\n";
    echo "DTEND:$dtEnd\r\n";
    echo "LOCATION:$loc\r\n";
    echo "DESCRIPTION:$desc\\nPlus d'informations: $url\r\n";
    echo "URL:$url\r\n";
    echo "END:VEVENT\r\n";
}

echo "END:VCALENDAR\r\n";
exit;
