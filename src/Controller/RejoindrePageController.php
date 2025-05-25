<?php
session_start();
require_once '../../config/database.php';
require_once '../Model/model-evenement.php';

if (!isset($_GET['event']) || !is_numeric($_GET['event'])) {
    header('Location: /Poker_website/public/index.php');
    exit;
}

$eventId = (int) $_GET['event'];
$evenement = Evenement::getById($eventId); // updated method name

if (!$evenement) {
    header('Location: /Poker_website/public/index.php');
    exit;
}

include '../View/view_rejoindre_evenement.php';
