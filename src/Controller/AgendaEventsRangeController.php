<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';

header('Content-Type: application/json; charset=utf-8');

$isAdmin = isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1;
if (!$isAdmin) {
    http_response_code(403);
    echo json_encode([
        'error' => 'Accès refusé.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$start = isset($_GET['start']) ? trim($_GET['start']) : '';
$end = isset($_GET['end']) ? trim($_GET['end']) : '';

$parseDate = function (string $value): ?DateTime {
    if ($value === '') {
        return null;
    }
    $dt = DateTime::createFromFormat('Y-m-d', $value);
    if (!$dt || $dt->format('Y-m-d') !== $value) {
        return null;
    }
    return $dt;
};

$startDate = $parseDate($start);
$endDate = $parseDate($end);

if (!$startDate || !$endDate) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Format de date invalide.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($startDate > $endDate) {
    [$startDate, $endDate] = [$endDate, $startDate];
}

$events = Evenement::getByDateRange($startDate->format('Y-m-d'), $endDate->format('Y-m-d'));

$payload = array_map(function ($event) {
    return [
        'id' => (int) $event['id_eve'],
        'title' => $event['eve_titre'],
        'date' => $event['eve_date'],
        'time' => $event['eve_heure'],
        'location' => $event['eve_lieu'],
        'type_id' => isset($event['id_type_eve']) ? (int) $event['id_type_eve'] : null,
    ];
}, $events);

echo json_encode([
    'count' => count($payload),
    'events' => $payload,
], JSON_UNESCAPED_UNICODE);
